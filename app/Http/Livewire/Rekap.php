<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\RekapService;

class Rekap extends Component
{
    public $nama, $awal, $akhir, $tunjangan, $detail;
    public $mode = '';

    public function mount()
    {
        $this->tunjangan = config('custom.tunjangan');
    }
    public function render(
        RekapService $rekap
    ) {
        return view('livewire.rekap.index', [
            'rekap' => $rekap->getData($this->awal, $this->akhir),
            'terlambat' => $rekap->getTerlambat($this->awal, $this->akhir),
            'pulang_awal' => $rekap->getPulangAwal($this->awal, $this->akhir)
        ]);
    }

    public function show(
        RekapService $rekap,
        $id
    ) {
        $this->mode = 'detail';
        $this->detail = $rekap->getDetail($id, $this->awal, $this->akhir);
    }
}
