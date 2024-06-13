<?php

namespace App\Http\Livewire;

use App\Models\Presensi;
use Livewire\Component;

class StatusPresensi extends Component
{
    public function render()
    {
        $data = Presensi::where('absenable_id', \Auth::user()->authable->id)
            ->where('absenable_type', 'App\\Models\\' . \Auth::user()->role())
            ->where('waktu', 'like', date('Y-m-d') . '%')
            ->get();
        $d = $p = '';

        if ($data->count()) {
            foreach ($data as $dt) {
                if (in_array($dt->jenis, ['h', 'i', 's', 'c', 'd', 't'])) {
                    $d = $dt->jenis;
                    // $k = $dt->keterangan;
                    // $no = $dt->no_surat;
                }
                if ($dt->jenis == 'p') $p = 'p';
            }
        }
        return view('livewire.dashboard.status-presensi', [
            'datang' => $d,
            'pulang' => $p
        ]);
    }
}
