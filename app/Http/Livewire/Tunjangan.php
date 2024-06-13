<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Tunjangan extends Component
{
    public $tunjangan;
    protected $rules = [
        'tunjangan.ontime' => 'required|numeric',
        'tunjangan.terlambat' => 'required|numeric',
        'tunjangan.lupa' => 'required|numeric',
    ];

    public function mount()
    {
        $this->tunjangan = config('custom.tunjangan');
    }
    public function render()
    {
        return view('livewire.tunjangan');
    }

    public function store()
    {
        $data = $this->validate();
        $str = '<?php ' . PHP_EOL . '$config = ' . var_export($data, true) . ';';
        file_put_contents(base_path('storage/app/config.php'), $str);

        $this->emit('alert', ['type' => 'success', 'message' => 'Pengaturan berhasil dismpan']);
        return redirect()->route('dashboard');
    }
}
