<?php

namespace App\Services;

use App\Models\Presensi;
use Illuminate\Support\Arr;
// use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class PresensiService
{
    public function cekKodePulang($user, $kode, $keterangan)
    {
        if ($kode == '') {
            // throw ValidationException::withMessages(['kode_pulang' => 'Kode harus diisi. Hubungi Administrator untuk mendapatkan kode.']);
            return [
                'error' => true,
                'message' => 'Kode harus diisi. Hubungi Administrator untuk mendapatkan kode.',
            ];
        }
        if ($kode != $user->authable->kode_pulang) {
            return [
                'error' => true,
                'message' => 'Kode tidak sesuai. Hubungi Administrator untuk mendapatkan kode.',
            ];
        }
        if ($keterangan == '') {
            return [
                'error' => true,
                'message' => 'Keterangan harus diisi',
            ];
        }

        //Hapus Kode
        $user->authable->update(['kode_pulang' => '']);
        return [
            'error' => false,
            'message' => '',
        ];
    }
    public function storeData($data)
    {
        Presensi::insert($data);
    }
    public function getJamKerja($user)
    {
        $jam = [];
        if ($user->authable->pembagian) {
            foreach ($user->authable->pembagian as $p) {
                foreach ($p->jam->jam as $j) {
                    $jam[$p->jam->id][$j['hari']] = [
                        'nama' => $p->jam->singkatan,
                        'waktu' => $j['datang'] . ' - ' . $j['pulang']
                    ];
                }
            }
        }
        return $jam;
    }
    public function presensiPublic()
    {
        $data = [];
        foreach (Presensi::with('absenable')
            ->where('waktu', 'like', date('Y-m-d') . '%')
            ->orderBy('waktu')
            ->get() as $d) {

            if (isset($data[$d->absenable->id])) {
                $data[$d->absenable->id]['jenis2'] = $d->jenis;
                $data[$d->absenable->id]['waktu2'] = explode(' ', $d->waktu)[1];
                $data[$d->absenable->id]['keterangan2'] = $d->keterangan;
            } else {
                $waktu = explode(' ', $d->waktu);
                $data[$d->absenable->id] = [
                    'nama' => $d->absenable->nama,
                    // 'no' => $d->absenable_type == 'App\\Dosen' ? $d->absenable->NIDN : $d->absenable->niy,
                    'hp' => $d->absenable->hp,
                    'foto' => $d->absenable->foto,
                    'jenis' => $d->jenis,
                    'jenis2' => '',
                    'tanggal' => $waktu[0],
                    'waktu' => $waktu[1],
                    'waktu2' => '',
                    'keterangan' => $d->keterangan,
                    'keterangan2' => '',
                    'no_surat' => $d->no_surat,
                ];
            }
        }

        return $data;
    }
    public function isJamKerjaAktif($jam_aktif)
    {
        $sekarang = time();
        return $sekarang > strtotime(date('Y-m-d ' . $jam_aktif['mulai_presensi'] . ':00')) &&
            $sekarang < strtotime(date('Y-m-d ' . $jam_aktif['selesai'] . ':00'));
    }

    public function isTerlambat($jenis, $waktu, $jam_aktif)
    {
        $sekarang = strtotime($waktu);

        if ($jenis == 'datang') {
            return $sekarang > strtotime(date('Y-m-d ' . $jam_aktif['mulai'] . ':00'));
        } elseif ($jenis == 'pulang') {
            return $sekarang > strtotime(date('Y-m-d ' . $jam_aktif['selesai_presensi'] . ':00'));
        }
    }

    public function getJenis($jenis)
    {
        $jenis_list = [
            'h' => 'Hadir',
            't' => 'Terlambat',
            'i' => 'Izin',
            's' => 'Sakit',
            'c' => 'Cuti',
            'd' => 'SPPD',
            'p' => 'Pulang'
        ];
        return $jenis == "datang" ? Arr::except($jenis_list, ['t', 'p']) : $jenis_list;
    }

    function sudahAbsen($data)
    {
        return Presensi::where('absenable_id', $data['absenable_id'])
            ->where('absenable_type', $data['absenable_type'])
            ->where('waktu', 'like', date('Y-m-d') . '%')

            ->when(
                $data['jenis'] == 'p',
                function ($w) {
                    $w->where('jenis', 'p');
                },
                function ($w) {
                    $w
                        ->where(function ($q) {
                            $q
                                ->where('jenis', 'h')
                                ->orWhere('jenis', 'i')
                                ->orWhere('jenis', 'c')
                                ->orWhere('jenis', 'd')
                                ->orWhere('jenis', 's')
                                ->orWhere('jenis', 't');
                        });
                }
            )
            ->exists();
    }

    function getJamKerjaHariIni($pembagian)
    {
        $waktu = new Carbon();
        $jam = [];
        foreach ($pembagian as $pb) {
            foreach ($pb->jam['jam'] as $j) {
                if (intval($j['hari']) == $waktu->dayOfWeek) {
                    $nama = $pb->jam->singkatan != '' ? $pb->jam->singkatan : $pb->jam->nama;
                    $m  = new Carbon();
                    $s  = new Carbon();

                    $d = explode(':', $j['datang']);
                    $p = explode(':', $j['pulang']);

                    $jam[$pb->jam->id] = [
                        'nama' => $nama,
                        'mulai' => $j['datang'],
                        'selesai' => $j['pulang'],
                        'mulai_presensi' => $m->setTime(intval($d[0]), intval($d[1]))->subMinutes($pb->jam->batas_mulai_presensi)->format('H:i'),
                        'selesai_presensi' => $s->setTime(intval($p[0]), intval($p[1]))->addMinutes($pb->jam->batas_akhir_presensi)->format('H:i'),
                        'batas_mulai_presensi' => $pb->jam->batas_mulai_presensi,
                        'batas_akhir_presensi' => $pb->jam->batas_akhir_presensi,
                    ];
                }
            }
        }
        return $jam;
    }
}
