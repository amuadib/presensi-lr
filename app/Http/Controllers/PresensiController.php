<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PresensiService;

class PresensiController extends Controller
{
    public function __invoke(PresensiService $ps, $jenis)
    {
        $form = [
            'jenis' => ''
        ];
        return view('livewire.presensi.layout', [
            'jenis' => $jenis,
            'jenis_presensi' => $ps->getJenis($jenis),
            'form' => $form
        ]);
    }
}
