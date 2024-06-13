<?php

namespace App\Services;

use App\Models\Presensi;

class RiwayatService
{
    public function deleteRiwayat($id)
    {
        return Presensi::find($id)->delete();
    }
    public function getRiwayat($request, $p)
    {
        $presensi = [];
        $tanggal = [];
        $offset = 0;
        $per_page = 30;

        $user = $request->user();
        if ($user->role() != 'Anggota') {
            $join = '';
            if ($user->role() == 'Petugas') {
                $join = ' INNER JOIN anggota
                ON anggota.id = absenable_id AND anggota.unit_kerja_id=' . $user->authable->unit_kerja_id;
            }
            $tanggal = \Cache::get('tanggal_presensi', function () use ($join) {
                $tanggal = [];
                $c = 1;
                foreach (\DB::select(
                    'select distinct date(waktu) as tgl
                from presensi ' . $join . '
                where date(waktu) <= date(now())
                order by tgl desc'
                ) as $t) {
                    $tanggal[$c] = $t->tgl;
                    $c++;
                }
                if (count($tanggal)) {
                    \Cache::put('tanggal_presensi', $tanggal, 300);
                }
                return $tanggal;
            });

            $presensi = Presensi::with('absenable', 'jam_kerja')
                ->when($user->role() == 'Petugas', function ($w) use ($user) {
                    $w
                        ->join('anggota', function ($j) use ($user) {
                            $j
                                ->on('anggota.id', '=', 'absenable_id')
                                ->where('anggota.unit_kerja_id', '=', $user->authable->unit_kerja_id);
                        });
                })
                ->when(isset($tanggal[$p]), function ($w) use ($tanggal, $p) {
                    $w
                        ->where('waktu', 'LIKE', $tanggal[$p] . ' %');
                })
                ->orderBy('absenable_id')
                ->orderBy('waktu', 'desc')
                ->get();

            $akhir = count($tanggal);
            $total = count($presensi);
        } else {
            $presensi = Presensi::with('absenable', 'jam_kerja')
                ->where('absenable_type', 'App\\Models\\Anggota')
                ->where('absenable_id', $request->user()->authable->id)
                ->orderBy('waktu', 'DESC');
            $total = $presensi->count();
            $akhir = ceil($total / $per_page);
            $offset = ($p - 1) * $per_page;
            $presensi = $presensi
                ->offset($offset)
                ->limit($per_page)
                ->get();
        }

        return [
            'presensi' => $presensi,
            'halaman' => [
                'sekarang' => intval($p),
                'akhir' => $akhir,
                'total' => $total,
                'mulai' => $offset,
                'sampai' => $offset + $per_page,
            ],
            'tanggal' => formatTanggal($tanggal[$p] ?? '', true)
        ];
    }
}
