<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\PenggunaService;
use App\Services\UnitService;
use App\Services\JamKerjaService;
use App\Services\LokasiKerjaService;
use App\Http\Requests\PenggunaRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class Pengguna extends Component
{
    public $mode = '';
    public $unit_id;
    public $pengguna = [];
    public $jam_kerja_id = [];
    public $status = [];
    public $unit_kerja, $jam_kerja, $lokasi, $foto, $updated_id, $password, $password_confirmation;

    protected function rules(): array
    {
        return (new PenggunaRequest())->rules();
    }

    public function mount(UnitService $us, JamKerjaService $js, LokasiKerjaService $ls)
    {
        if (!Gate::allows('Administrator')) {
            abort(403);
        }
        $this->status = config('custom.status_sipil');
        $this->unit_kerja = $us->getData();
        $this->jam_kerja = $js->getData();
        $this->lokasi = $ls->getData();
    }
    public function getKodePulang($id)
    {
        $me = \Auth::user();
        $user = User::find($id);
        $blacklist = $me->authable->blacklist_kode_pulang;
        $blacklisted = false;

        //Petugas
        if ($user->role() !== 'Anggota') {
            $this->emit('alert', ['type' => 'warning', 'message' => 'Kode Pulang tidak dapat dibuat.']);
            return;
        }

        //Petugas mempunyai blacklist
        if (is_array($blacklist) && count(($blacklist)) > 0) {
            foreach ($blacklist as $b) {
                if ($b['type'] == $user->role() && $b['id'] == $user->authable_id) {
                    $blacklisted = true;
                    break;
                }
            }
        }

        if ($blacklisted) {
            $this->emit('alert', ['type' => 'warning', 'message' => 'Kode Pulang tidak dapat dibuat.']);
            return;
        }

        $user->authable->update(['kode_pulang' => rand(111, 999) . rand(111, 999)]);
    }
    public function setAktif($id, $status)
    {
        User::find($id)->authable->update(['aktif' => $status]);
    }
    public function setKunci($id, $status)
    {
        User::find($id)->authable->update(['kunci_foto' => $status]);
    }
    public function render(PenggunaService $ps)
    {
        $this->foto = $this->pengguna['foto'] = \Cache::get('foto_tmp', function () {
            return 'not-found.jpg';
        });
        return view('livewire.pengguna.index', [
            'data' => $ps->getData(null, $this->unit_id),
            'user' => \Auth::user()
        ]);
    }

    public function create()
    {
        $this->mode = 'create';
        $this->reset(['pengguna', 'foto']);
        \Cache::forget('foto_tmp');
    }

    public function store(PenggunaService $ps)
    {
        $validated = $this->validate();
        $ps->storeData($validated);
        $this->reset('mode');
        $this->emit('alert', ['type' => 'success', 'message' => 'Pengguna berhasil disimpan']);
        \Cache::forget('foto_tmp');
    }

    public function edit(PenggunaService $ps, $id)
    {
        $this->mode = 'edit';
        $this->updated_id = $id;
        $this->pengguna = $ps->getData($id);
        $this->jam_kerja_id = $this->pengguna['jam_kerja_id'];
        \Cache::set('foto_tmp', $this->pengguna['foto'], 300);
    }

    public function update(PenggunaService $ps)
    {
        $validated = $this->validate();
        $ps->updateData($this->updated_id, $validated);
        $this->reset('mode');
        $this->emit('alert', ['type' => 'success', 'message' => 'Pengguna berhasil diperbarui']);
        \Cache::forget('foto_tmp');
    }

    public function editPassword(PenggunaService $ps, $id)
    {
        $this->mode = 'change';
        $this->updated_id = $id;
        $this->pengguna = $ps->getData($id);
    }
    public function updatePassword(PenggunaService $ps)
    {
        $validated = $this->validate([
            'password' => ['required', 'confirmed'],
        ]);
        if ($ps->updatePassword($this->updated_id, $validated['password'])) {
            $this->emit('alert', ['type' => 'success', 'message' => 'Password pengguna berhasil diperbarui']);
        } else {
            $this->emit('alert', ['type' => 'error', 'message' => 'Password pengguna gagal diperbarui']);
        }
        $this->reset('mode');
    }
    public function destroy(PenggunaService $ps, $id)
    {
        if ($ps->destroyData($id)) {
            $this->emit('alert', ['type' => 'success', 'message' => 'Pengguna berhasil dihapus']);
        } else {
            $this->emit('alert', ['type' => 'error', 'message' => 'Pengguna gagal dihapus']);
        }
    }
}
