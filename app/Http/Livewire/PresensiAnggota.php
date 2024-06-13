<?php

namespace App\Http\Livewire;

// use App\Models\Jam;
use App\Models\Presensi;
use Livewire\Component;
use Carbon\Carbon;

class PresensiAnggota extends Component
{
    public function render()
    {
        // $waktu = new Carbon();
        $ada_jam_kerja = false;
        $user = \Auth::user();
        $pembagian = $user->authable->pembagian;
        if ($pembagian->count()) {
            $ada_jam_kerja = true;
        }

        $data = Presensi::where('absenable_id', $user->authable->id)
            ->where('absenable_type', 'App\\Models\\' . $user->role())
            ->where('waktu', 'like', date('Y-m-d') . '%')
            ->get();

        $datang = $pulang = $keterangan = $no = '';

        //Ada data Presensi
        // if ($data->count()) {
        $jam_id = 0;
        foreach ($data as $dt) {
            if ($jam_id == 0) {
                $jam_id = $dt->jam_id;
            }
            if (in_array($dt->jenis, ['h', 'i', 's', 'c', 'd', 't'])) {
                $datang = $dt->jenis;
                $keterangan = $dt->keterangan;
                $no = $dt->no_surat;
            }
            if ($dt->jenis == 'p') {
                $pulang = 'p';
            }
        }
        // $pb = Jam::find($jam_id);
        // $jam = [
        //     'id' => $pb->id,
        //     'awal' => $pb->batas_mulai_presensi,
        //     'akhir' => $pb->batas_akhir_presensi,
        //     'aktif' => 'y',
        //     'kerja' => $pb->jam
        // ];
        // } else {
        // $jam = $this->getPembagianAktif($pembagian);
        // }

        // \Cache::set(
        //     'jam_aktif',
        //     [
        //         'id' => $jam['id'],
        //         'datang' => $jam['kerja'][$waktu->dayOfWeek]['datang'],
        //         'pulang' => $jam['kerja'][$waktu->dayOfWeek]['pulang'],
        //         'awal' => $jam['awal'],
        //         'akhir' => $jam['akhir'],
        //     ],
        //     300
        // );
        // dd($datang);
        return view('livewire.dashboard.presensi-anggota', [
            'ada_jam_kerja' => $ada_jam_kerja,
            'jam_id' => $jam_id,
            'status' => [
                'datang' => $datang,
                'pulang' => $pulang,
                'keterangan' => $keterangan,
            ]
        ]);
    }

    // private function getPembagianAktif($pembagian)
    // {
    //     $aktif =  [
    //         'id' => '',
    //         'awal' => '',
    //         'akhir' => '',
    //         'aktif' => '',
    //         'kerja' => [],
    //     ];
    //     $waktu = new Carbon();

    //     foreach ($pembagian as $pb) {
    //         foreach ($pb->jam['jam'] as $j) {
    //             if (intval($j['hari']) == $waktu->dayOfWeek) {
    //                 if ($this->isJamValid($j['datang']) and $this->isJamValid($j['pulang'])) {
    //                     $datang  = new Carbon();
    //                     $pulang  = new Carbon();
    //                     $d = explode(':', $j['datang']);
    //                     $p = explode(':', $j['pulang']);
    //                     $awal = $datang->setTime(intval($d[0]), intval($d[1]))->subMinutes($pb->jam->batas_mulai_presensi);
    //                     $akhir = $pulang->setTime(intval($p[0]), intval($p[1]))
    //                         // ->addMinutes($pb->jam->batas_akhir_presensi)
    //                     ;

    //                     if ($waktu >= $awal and $waktu <= $akhir) {
    //                         $aktif = [
    //                             'id' => $pb->jam->id,
    //                             'awal' => $pb->jam->batas_mulai_presensi,
    //                             'akhir' => $pb->jam->batas_akhir_presensi,
    //                             'aktif' => 'y',
    //                             'kerja' => $pb->jam->jam
    //                         ];
    //                         break 2;
    //                     } else {
    //                         $aktif = [
    //                             'id' => $pb->jam->id,
    //                             'awal' => $pb->jam->batas_mulai_presensi,
    //                             'akhir' => $pb->jam->batas_akhir_presensi,
    //                             'aktif' => 'n',
    //                             'kerja' => $pb->jam->jam
    //                         ];
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     return $aktif;
    // }
    // private function isJamValid($jam)
    // {
    //     return preg_match('#^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$#', $jam . ':00');
    // }
}
