<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Anggota;
use App\Models\Pembagian;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class PenggunaService
{
    public function getData($id = null, $unit_id = 0)
    {
        if ($id === null) {

            $user = \Auth::user();
            return User::with('authable')
                ->when($unit_id > 0, function ($when) use ($unit_id) {
                    $when
                        ->whereHasMorph(
                            'authable',
                            [Anggota::class],
                            function ($query) use ($unit_id) {
                                $query
                                    ->where('unit_kerja_id', $unit_id);
                            }
                        );
                })
                ->when($user->role() == 'Petugas', function ($w) use ($user) {
                    $w
                        ->join('anggota', function ($j) use ($user) {
                            $j
                                ->on('anggota.id', '=', 'authable_id')
                                ->where('anggota.unit_kerja_id', '=', $user->authable->unit_kerja_id);
                        });
                })
                ->get(['users.*'])
                ->sortByDesc(function ($user) {
                    return $user->authable->aktif;
                });
        } else {
            $user = User::find($id);
            $pengguna = $user->authable;
            $pengguna['jenis_akun'] = $user->jenis_akun();
            if ($pengguna['jenis_akun'] == 'b') {
                $jam_kerja_id = [];
                $pengguna['lokasi_id'] = '';
                if (isset($pengguna->pembagian)) {
                    foreach ($pengguna->pembagian as $p) {
                        $jam_kerja_id[$p->jam_id] = $p->jam_id;
                        $pengguna['lokasi_id'] = $p->lokasi_id;
                    }
                }
                $pengguna['jam_kerja_id'] = $jam_kerja_id;
            }
            return $pengguna;
        }
    }
    public function storeData($data)
    {
        $pengguna = $data['pengguna'];
        $pengguna['hp'] = preg_replace('/[^0-9]/', '', $pengguna['hp']);
        $input = Arr::except($pengguna, ['jenis_akun', 'lokasi_id']);
        if ($pengguna['jenis_akun'] == 'a') {
            $tipe = 'App\Models\Admin';
            // $username = $pengguna['hp'];
            $authable = Admin::create(Arr::except($input, ['unit_kerja_id', 'jabatan']));
        } elseif ($pengguna['jenis_akun'] == 'p') {
            $tipe = 'App\Models\Petugas';
            // $username = $pengguna['hp'];
            $authable = Petugas::create(Arr::except($input, ['jabatan']));
        } else {
            $tipe = 'App\Models\Anggota';
            // $username = $pengguna['hp'];
            $authable = Anggota::create($input);
            $this->setPembagianJam($authable->id, $data['jam_kerja_id'], $pengguna['lokasi_id']);
        }
        User::create([
            'username' => $input['hp'],
            'password' => Hash::make($input['hp']),
            'authable_type' => $tipe,
            'authable_id' => $authable->id
        ]);
    }
    public function updateData($id, $data)
    {
        $pengguna = $data['pengguna'];
        $pengguna['hp'] = preg_replace('/[^0-9]/', '', $pengguna['hp']);
        $input = Arr::except($pengguna, ['jenis_akun', 'lokasi_id']);

        $auth = User::find($id)->authable;
        if ($pengguna['jenis_akun'] == 'a') {
            $input = Arr::except($input, ['unit_kerja_id', 'jabatan']);
        } elseif ($pengguna['jenis_akun'] == 'p') {
            $input = Arr::except($input, ['jabatan']);
        } else {
            $this->setPembagianJam($auth->id, $data['jam_kerja_id'], $pengguna['lokasi_id']);
        }
        return $auth->update($input);
    }
    public function destroyData($id)
    {
        $user = User::find($id);
        if (!$user) {
            return false;
        }

        if ($user->jenis_akun() == 'a') {
            Admin::find($user->authable_id)->delete();
        } elseif ($user->jenis_akun() == 'p') {
            Petugas::find($user->authable_id)->delete();
        } else {
            Anggota::find($user->authable_id)->delete();
        }
        return $user->delete();
    }
    public function updatePassword($id, $password)
    {
        return User::find($id)->update([
            'password' => Hash::make($password)
        ]);
    }

    public function setPembagianJam($authable_id, $jam, $lokasi_id): void
    {
        $pembagian = [];
        if (count($jam)) {
            foreach ($jam as $d) {
                if (intval($d) > 0) {
                    $pembagian[] = [
                        'absenable_id' => $authable_id,
                        'absenable_type' => 'App\\Models\\Anggota',
                        'jam_id' => $d,
                        'lokasi_id' => $lokasi_id,
                    ];
                }
            }
            Pembagian::where('absenable_type', 'App\Models\Anggota')
                ->where('absenable_id', $authable_id)
                ->delete();
        }

        if (count($pembagian)) {
            Pembagian::insert($pembagian);
        }
    }
}
