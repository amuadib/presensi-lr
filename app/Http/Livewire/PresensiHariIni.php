<?php

namespace App\Http\Livewire;

use App\Models\Presensi;
use Livewire\Component;

class PresensiHariIni extends Component
{
    public function render()
    {
        $user = \Auth::user();
        return view('livewire.dashboard.presensi-hari-ini', [
            'presensi' => Presensi::with('absenable')
                ->when($user->role() == 'Petugas', function ($w) use ($user) {
                    $w
                        ->join('anggota', function ($j) use ($user) {
                            $j
                                ->on('anggota.id', '=', 'absenable_id')
                                ->where('anggota.unit_kerja_id', '=', $user->authable->unit_kerja_id);
                        });
                })
                ->where('waktu', 'LIKE', date('Y-m-d') . '%')
                ->orderBy('waktu', 'DESC')
                ->get()
        ]);
    }
}
