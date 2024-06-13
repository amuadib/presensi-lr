<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Services\RiwayatService;

class Riwayat extends Component
{
    public $page = 1;
    public $last_page = 1;
    public function render(
        Request $request,
        RiwayatService $riwayat
    ) {
        $r = $riwayat->getRiwayat($request, $this->page);
        $this->last_page = $r['halaman']['akhir'];
        return view(
            'livewire.riwayat.index',
            $r
        );
    }

    public function prev()
    {
        if ($this->page < $this->last_page) {
            $this->page++;
        }
    }
    public function next()
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }
    public function destroy(RiwayatService $riwayat, $id)
    {
        if ($riwayat->deleteRiwayat($id)) {
            $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil dihapus']);
        } else {
            $this->emit('alert', ['type' => 'error', 'message' => 'Data gagal dihapus']);
        }
    }
}
