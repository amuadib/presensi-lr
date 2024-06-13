<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\LokasiKerjaService;
use App\Http\Requests\LokasiKerjaRequest;

class LokasiKerja extends Component
{
    public $mode = '';
    public $form, $updated_id;
    protected function rules(): array
    {
        return (new LokasiKerjaRequest())->rules();
    }
    public function render(LokasiKerjaService $lk)
    {
        return view('livewire.lokasi-kerja.index', [
            'lokasi' => $lk->getData()
        ]);
    }
    public function create()
    {
        $this->mode = 'create';
        $this->reset('form');
    }

    public function store(LokasiKerjaService $lk)
    {
        $validated = $this->validate();
        $lk->storeData($validated['form']);
        $this->reset('mode');
        $this->emit('alert', ['type' => 'success', 'message' => 'Lokasi Kerja berhasil disimpan']);
    }

    public function edit(LokasiKerjaService $lk, $id)
    {
        $this->mode = 'edit';
        $this->updated_id = $id;
        $this->form = $lk->getData($id);
    }

    public function update(LokasiKerjaService $lk)
    {
        $validated = $this->validate();
        $lk->updateData($this->updated_id, $validated['form']);
        $this->reset('mode');
        $this->emit('alert', ['type' => 'success', 'message' => 'Lokasi Kerja berhasil diperbarui']);
    }

    public function destroy(LokasiKerjaService $lk, $id)
    {
        if ($lk->destroyData($id)) {
            $this->emit('alert', ['type' => 'success', 'message' => 'Lokasi Kerja berhasil dihapus']);
        } else {
            $this->emit('alert', ['type' => 'error', 'message' => 'Lokasi Kerja gagal dihapus']);
        }
    }
}
