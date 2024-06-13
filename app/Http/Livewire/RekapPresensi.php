<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RekapPresensi extends Component
{
    public function render()
    {
        return view('livewire.dashboard.rekap-presensi', [
            'rekap' => \DB::select("select
    sum(if(jenis='h',1,0)) as hadir,
    sum(if(jenis='p',1,0)) as pulang,
    sum(if(jenis='i',1,0)) as izin,
    sum(if(jenis='s',1,0)) as sakit,
    sum(if(jenis='c',1,0)) as cuti,
    sum(if(jenis='d',1,0)) as sppd,
    sum(if(jenis='t',1,0)) as terlambat
    from presensi
    where absenable_id = :id
    AND absenable_type= :type
    AND waktu LIKE :waktu", [
                'id' => \Auth::user()->authable->id,
                'type' => 'App\\Models\\' . \Auth::user()->role(),
                'waktu' =>  date('Y-m-') . '%'
            ])[0]
        ]);
    }
}
