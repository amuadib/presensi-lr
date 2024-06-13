<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RekapPresensiAdmin extends Component
{
    public function render()
    {
        $user = \Auth::user();
        $join = '';
        if ($user->role() == 'Petugas') {
            $join = ' INNER JOIN anggota
            ON anggota.id = absenable_id AND anggota.unit_kerja_id=' . $user->authable->unit_kerja_id;
        }
        //REKAP
        $rekap = \DB::select("select
sum(if(jenis='h',1,0)) as hadir,
sum(if(jenis='i',1,0)) as izin,
sum(if(jenis='s',1,0)) as sakit,
sum(if(jenis='c',1,0)) as cuti,
sum(if(jenis='d',1,0)) as sppd,
sum(if(jenis='t',1,0)) as terlambat
from presensi " . $join . "
where waktu LIKE :bulan", [
            'bulan' =>  date('Y-m-') . '%'
        ])[0];

        $lalu = \DB::select("select
sum(if(jenis='h',1,0)) as hadir,
sum(if(jenis='i',1,0)) as izin,
sum(if(jenis='s',1,0)) as sakit,
sum(if(jenis='c',1,0)) as cuti,
sum(if(jenis='d',1,0)) as sppd,
sum(if(jenis='t',1,0)) as terlambat
from presensi " . $join . "
where waktu LIKE :waktu", [
            'waktu' =>  date('Y-m-', strtotime('first day of last month')) . '%'
        ])[0];

        return view(
            'livewire.dashboard.rekap-presensi-admin',
            [
                'hadir' => [
                    'jml' => $rekap->hadir,
                    'bl' => [
                        'a' => $rekap->hadir == $lalu->hadir ? 's' : ($rekap->hadir > $lalu->hadir ? 'n' : 't'),
                        'p' => $lalu->hadir == 0 ? 0 : round(abs($rekap->hadir - $lalu->hadir) / $lalu->hadir * 100, 2)
                    ]
                ],
                'sakit' => [
                    'jml' => $rekap->sakit,
                    'bl' => [
                        'a' => $rekap->sakit == $lalu->sakit ? 's' : ($rekap->sakit > $lalu->sakit ? 'n' : 't'),
                        'p' => $lalu->sakit == 0 ? 0 : round(abs($rekap->sakit - $lalu->sakit) / $lalu->sakit * 100, 2)
                    ]
                ],
                'izin' => [
                    'jml' => $rekap->izin,
                    'bl' => [
                        'a' => $rekap->izin == $lalu->izin ? 's' : ($rekap->izin > $lalu->izin ? 'n' : 't'),
                        'p' => $lalu->izin == 0 ? 0 : round(abs($rekap->izin - $lalu->izin) / $lalu->izin * 100, 2)
                    ]
                ],
                'terlambat' => [
                    'jml' => $rekap->terlambat,
                    'bl' => [
                        'a' => $rekap->terlambat == $lalu->terlambat ? 's' : ($rekap->terlambat > $lalu->terlambat ? 'n' : 't'),
                        'p' => $lalu->terlambat == 0 ? 0 : round(abs($rekap->terlambat - $lalu->terlambat) / $lalu->terlambat * 100, 2)
                    ]
                ]
            ]
        );
    }
}
