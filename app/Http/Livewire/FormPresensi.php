<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\PresensiService;
use App\Services\WajahService;

class FormPresensi extends Component
{
    use WithFileUploads;

    public $jenis, $lokasi, $nama, $unit, $tanggal, $tgl1, $tgl2, $jam, $kode_pulang, $jam_kerja, $jam_kerja_id, $user_id, $lampiran;
    public $form = [];
    public $jenis_presensi = [];
    public $foto = '';

    public $isAllCheckPassed = false;

    public $isLoadingGPS = false;
    public $isOutOfRange = false;
    public $isLocationCheckPassed = false;

    public $isFaceCheckPassed = false;
    public $isFaceCheckProcessing = false;
    public $isFaceCheckError = false;
    public $faceCheckErrorMessage = '';

    public function mount(PresensiService $ps, $jenis, $id = 0)
    {
        if (env('APP_ENV') == 'local') {
            $this->isAllCheckPassed = true;
        }

        $waktu = date('Y-m-d H:i:s');
        $user = \Auth::user();
        $this->user_id = $user->id;
        $this->jam_kerja_id = $id;
        $this->jam_kerja = $ps->getJamKerjaHariIni($user->authable->pembagian);
        $this->lokasi = $user->authable->pembagian[0]->lokasi;
        $this->jenis = $jenis;
        $this->jenis_presensi = $ps->getJenis($jenis);
        $this->tanggal = explode(' ', $waktu)[0];
        $this->jam = explode(' ', $waktu)[1];
        $this->nama = $user->authable->nama;
        $this->unit = $user->authable->unit->nama;
        $this->form['jam_id'] = $id;
        $this->form['absenable_id'] = $user->authable->id;
        $this->form['absenable_type'] = 'App\\Models\\Anggota';
        $this->form['jenis'] = '';
        $this->form['lat'] = 0;
        $this->form['lon'] = 0;
        $this->form['waktu'] = $waktu;
        $this->form['keterangan'] = '';
        $this->form['no_surat'] = '';
    }
    public function render()
    {
        return view('livewire.presensi.layout');
    }

    public function store(PresensiService $ps)
    {
        $waktu_submit = date('Y-m-d H:i:s');
        $data = [];
        if ($this->jam_kerja_id == null) {
            $this->emit('alert', ['type' => 'error', 'message' => 'Silahkan pilih Jam Kerja terlebih dahulu.']);
            return;
        }

        if (env('ALLOWED_SUBNET') != '') {
            if (!ip_in_range(getIp(), env('ALLOWED_SUBNET'))) {
                $this->emit('alert', ['type' => 'error', 'message' => 'Presensi diluar Jaringan yang diperbolehkan.']);
                return;
            }
        }

        if (!in_array($this->form['jenis'], ['i', 's', 'c', 'd'])) {
            if (!$this->isDalamRadius(
                [
                    $this->form['lat'],
                    $this->form['lon'],
                ]
            )) {
                $this->emit('alert', ['type' => 'error', 'message' => 'Posisi diluar radius.']);
                return;
            }
        }
        $storage = \Storage::disk('wajah');
        $test_file = 'wajah_' . $this->user_id . '_test_' . date('Y-m-d') . '.jpg';

        if ($this->jenis == 'datang') {

            if ($this->form['jenis'] == '') {
                $this->emit('alert', ['type' => 'error', 'message' => 'Silahkan pilih Jenis Presensi terlebih dahulu.']);
                return;
            }

            if ($ps->sudahAbsen($this->form)) {
                $this->emit('alert', ['type' => 'error', 'message' => 'Anda telah melakukan Presensi hari ini.']);
                return;
            }

            if ($this->form['jenis'] == 'i') {
                $cek = $ps->cekKodePulang(\Auth::user(), $this->kode_pulang, $this->form['keterangan']);
                if ($cek['error']) {
                    $this->emit('alert', ['type' => 'error', 'message' => $cek['message']]);
                    return;
                }
            }
            if ($this->form['jenis'] == 's') {
                if ($this->lampiran != null) {
                    $ext = substr($this->lampiran->getClientOriginalName(), -4);
                    $file = 'surat_dokter_' . $this->user_id . '_' . $this->jam_kerja_id . '_' . date('Y-m-d') . $ext;
                    $this->lampiran->storeAs('upload/lampiran', $file);
                    $this->form['lampiran'] = $file;
                }
            }

            $jam_aktif = $this->jam_kerja[$this->jam_kerja_id];

            if (!$ps->isJamKerjaAktif($jam_aktif)) {
                $this->emit('alert', ['type' => 'error', 'message' => 'Presensi diluar Jam Kerja. Presensi bisa dimulai pukul ' . $jam_aktif['mulai_presensi'] . ' sampai ' . $jam_aktif['selesai_presensi']]);
                return;
            }

            $this->form['jam_id'] = $this->jam_kerja_id;

            if ($this->form['jenis'] == 'h' && $ps->isTerlambat($this->jenis, $waktu_submit, $jam_aktif)) {
                $this->form['jenis'] = 't';
                $this->form['keterangan'] = 'Terlambat ' . timeDiff(strtotime($waktu_submit), strtotime($jam_aktif['mulai']));
            }
            if ($this->form['jenis'] == 'c' || $this->form['jenis'] == 'd') {
                $begin = new \DateTime($this->tgl1);
                $end = new \DateTime($this->tgl2);
                $end->setTime(0, 0, 1);

                $interval = \DateInterval::createFromDateString('1 day');
                $period = new \DatePeriod($begin, $interval, $end);
                $tmp = [];
                foreach ($period as $dt) {
                    $tmp[] = [
                        'jam_id' => $this->jam_kerja_id,
                        'absenable_id' => $this->form['absenable_id'],
                        'absenable_type' => $this->form['absenable_type'],
                        'jenis' => $this->form['jenis'],
                        'waktu' => $dt->format('Y-m-d H:i:s'),
                        'keterangan' => $this->form['keterangan'],
                        'no_surat' => $this->form['no_surat']
                    ];
                }
            }
            if ($storage->exists($test_file)) {
                $storage->move($test_file, 'wajah_' . $this->user_id . '_test_d_' . date('Y-m-d') . '.jpg');
            }
        } else {
            $jam_aktif = $this->jam_kerja[$this->jam_kerja_id];
            $this->form['jenis'] = 'p';

            // $presensi_pulang_awal = $ps->isJamKerjaAktif($jam_aktif);
            // $presensi_pulang_terlambat = $ps->isTerlambat($this->jenis, $this->form['waktu'], $jam_aktif);

            if ($ps->sudahAbsen($this->form)) {
                $this->emit('alert', ['type' => 'error', 'message' => 'Anda telah melakukan Presensi hari ini.']);
                return;
            }

            if (
                $ps->isJamKerjaAktif($jam_aktif)
                or
                $ps->isTerlambat($this->jenis, $waktu_submit, $jam_aktif)
            ) {
                $cek = $ps->cekKodePulang(\Auth::user(), $this->kode_pulang, $this->form['keterangan']);
                if ($cek['error']) {
                    $this->emit('alert', ['type' => 'error', 'message' => $cek['message']]);
                    return;
                }
            }
            if ($ps->isTerlambat($this->jenis, $waktu_submit, $jam_aktif)) {
                $keterangan = 'Terlambat ' . timeDiff(strtotime($waktu_submit), strtotime($jam_aktif['selesai'])) .
                    '. Keterangan: ' . $this->form['keterangan'];
                $this->form['keterangan'] = $keterangan;
            }

            if ($storage->exists($test_file)) {
                $storage->move($test_file, 'wajah_' . $this->user_id . '_test_p_' . date('Y-m-d') . '.jpg');
            }
        }

        $data = isset($tmp) ? $tmp : $this->form;

        $ps->storeData($data);
        $this->emit('alert', ['type' => 'success', 'message' => 'Data telah disimpan, Terima kasih']);
        return redirect()->to('/');
    }
    function verifikasiWajah(WajahService $ws, $data)
    {
        $this->reset([
            'isAllCheckPassed',
            'isFaceCheckPassed',
            'isFaceCheckProcessing',
            'isFaceCheckError',
            'faceCheckErrorMessage'
        ]);
        $this->isFaceCheckProcessing = true;

        $test = $ws->match(\Auth::user()->authable->foto, $data);
        if ($test['code'] != '99') {
            $this->isFaceCheckError = true;
            $this->faceCheckErrorMessage = $test['message'];
            $this->isFaceCheckProcessing = false;
        } else {
            $this->isFaceCheckPassed = true;
            $this->foto = $data;
            $this->isFaceCheckProcessing = false;
        }

        if ($this->isFaceCheckPassed && $this->isLocationCheckPassed) {
            $this->isAllCheckPassed = true;
        }
        if (env('APP_ENV') == 'local') {
            $this->isAllCheckPassed = true;
        }
    }

    function isDalamRadius($pos)
    {
        if (env('APP_ENV') == 'local') {
            return true;
        }
        $jarak = $this->getDistanceInMeter(
            $pos[0],
            $pos[1],
            $this->lokasi['lat'],
            $this->lokasi['lon'],
        );
        if ($jarak <= $this->lokasi['radius']) {
            return true;
        }
        return false;
    }
    function resetLocation()
    {
        $this->isLoadingGPS = true;
        $this->reset([
            'isAllCheckPassed',
            // 'isLoadingGPS',
            'isLocationCheckPassed',
            'isOutOfRange',
        ]);
    }
    function checkCoord($pos)
    {
        // $this->resetLocation();

        if (env('APP_ENV') == 'local') {
            $this->isLoadingGPS = false;
            $this->isAllCheckPassed = true;
            $this->isLocationCheckPassed = true;
            $this->isOutOfRange = false;
            return;
        }

        $isJenisChecked = $this->jenis == 'datang' && $this->form['jenis'] == 'h' ? true : false;
        $jarak = $this->getDistanceInMeter(
            $pos[0],
            $pos[1],
            $this->lokasi['lat'],
            $this->lokasi['lon'],
        );

        if ($jarak > 0) {
            $this->isLoadingGPS = false;
        }

        // if ($this->jenis == 'datang') {
        // }

        if ($isJenisChecked && $jarak > $this->lokasi['radius']) {
            $this->isLocationCheckPassed = false;
            $this->isOutOfRange = true;
        } else {
            $this->isLocationCheckPassed = true;
            $this->isOutOfRange = false;
            $this->form['lat'] = $pos[0];
            $this->form['lon'] = $pos[1];
        }
        if ($this->isFaceCheckPassed && $this->isLocationCheckPassed) {
            $this->isAllCheckPassed = true;
        }
    }
    private function getDistanceInMeter($lat1, $lon1, $lat2, $lon2)
    {
        $R = 6371000; // Radius of the earth in m
        $dLat = $this->deg2rad($lat2 - $lat1); // deg2rad below
        $dLon = $this->deg2rad($lon2 - $lon1);
        $a =
            sin($dLat / 2) * sin($dLat / 2) +
            cos($this->deg2rad($lat1)) * cos($this->deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $d = $R * $c; // Distance in m
        return round($d, 2);
    }

    private function deg2rad($deg)
    {
        return $deg * (M_PI / 180);
    }
}
