<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\JamKerjaService;
use App\Http\Requests\JamKerjaRequest;

class JamKerja extends Component
{
    public $mode = '';
    public $hari_list, $form, $updated_id;

    protected function rules(): array
    {
        return (new JamKerjaRequest())->rules();
    }

    public function mount()
    {
        $this->hari_list = config('custom.hari');
    }

    public function render(JamKerjaService $jk)
    {
        return view('livewire.jam-kerja.index', [
            'jam' => $jk->getData()
        ]);
    }

    public function create()
    {
        $this->mode = 'create';
        $this->reset('form');
        foreach ($this->hari_list as $k => $v) {
            $this->form['jam'][$k]['hari'] = $k;
            $this->form['jam'][$k]['datang'] = '-';
            $this->form['jam'][$k]['pulang'] = '-';
        }
    }

    public function store(JamKerjaService $jk)
    {
        $validated = $this->validate();
        $jk->storeData($validated['form']);
        $this->reset('mode');
        $this->emit('alert', ['type' => 'success', 'message' => 'Jam Kerja berhasil disimpan']);
    }

    public function edit(JamKerjaService $jk, $id)
    {
        $this->mode = 'edit';
        $this->updated_id = $id;
        $this->form = $jk->getData($id);
    }

    public function update(JamKerjaService $jk)
    {
        $validated = $this->validate();
        $jk->updateData($this->updated_id, $validated['form']);
        $this->reset('mode');
        $this->emit('alert', ['type' => 'success', 'message' => 'Jam Kerja berhasil diperbarui']);
    }

    public function destroy(JamKerjaService $jk, $id)
    {
        if ($jk->destroyData($id)) {
            $this->emit('alert', ['type' => 'success', 'message' => 'Jam Kerja berhasil dihapus']);
        } else {
            $this->emit('alert', ['type' => 'error', 'message' => 'Jam Kerja gagal dihapus']);
        }
    }
}
