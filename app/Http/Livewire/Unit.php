<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\UnitService;
use App\Http\Requests\UnitRequest;

class Unit extends Component
{
    public $mode = '';
    public $nama, $updated_id;

    protected function rules(): array
    {
        return (new UnitRequest())->rules();
    }

    public function render(UnitService $unit)
    {
        return view('livewire.unit-kerja.index', ['data' => $unit->getData()]);
    }

    public function create()
    {
        $this->mode = 'create';
        $this->reset('nama');
    }

    public function store(UnitService $unit)
    {
        $unit->storeData($this->validate());
        $this->reset('mode');
        $this->emit('alert', ['type' => 'success', 'message' => 'Unit Kerja berhasil disimpan']);
    }
    public function edit(UnitService $unit, $id)
    {
        $this->mode = 'edit';
        $this->updated_id = $id;
        $data = $unit->getData($id);
        $this->nama = $data->nama;
    }

    public function update(UnitService $unit)
    {
        if ($unit->updateData($this->updated_id, $this->validate())) {
            $this->reset('mode');
            $this->emit('alert', ['type' => 'success', 'message' => 'Unit Kerja berhasil diperbarui']);
        } else {
            $this->emit('alert', ['type' => 'error', 'message' => 'Unit Kerja gagal diperbarui']);
        }
    }
    public function destroy(UnitService $unit, $id)
    {
        if ($unit->destroyData($id)) {
            $this->emit('alert', ['type' => 'success', 'message' => 'Unit Kerja berhasil dihapus']);
        } else {
            $this->emit('alert', ['type' => 'error', 'message' => 'Unit Kerja gagal dihapus']);
        }
    }
}
