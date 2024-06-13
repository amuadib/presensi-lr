<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\PresensiService;

class PresensiPublic extends Component
{
    public function render(PresensiService $ps)
    {
        return view('livewire.presensi-public', [
            'presensi' => $ps->presensiPublic()
        ]);
    }
}
