<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GrafikPresensi extends Component
{
    public function render()
    {
        $line_chart_data = $bar_chart_data = [];
        $line_chart_data['labels'] = [];
        $hadir = $izin = $sakit = $cuti = $terlambat = $sppd = [];

        $user = \Auth::user();
        $join = '';
        if ($user->role() == 'Petugas') {
            $join = ' INNER JOIN anggota
            ON anggota.id = absenable_id AND anggota.unit_kerja_id=' . $user->authable->unit_kerja_id;
        }

        //GRAFIK MINGGUAN
        foreach (\DB::select("SELECT
                DATE(waktu) AS tanggal,
                sum(if(jenis='h',1,0)) as hadir,
            sum(if(jenis='i',1,0)) as izin,
            sum(if(jenis='s',1,0)) as sakit,
            sum(if(jenis='c',1,0)) as cuti,
            sum(if(jenis='d',1,0)) as sppd,
            sum(if(jenis='t',1,0)) as terlambat
            FROM presensi " . $join . "
            WHERE str_to_date(waktu, '%Y-%m-%d %H:%i:%s') >= current_date - INTERVAL 7 DAY
            GROUP BY DATE(waktu)") as $s) {
            $tgl = explode('-', $s->tanggal);
            $line_chart_data['labels'][] = $tgl[2] . '-' . $tgl[1] . '-' . $tgl[0];
            $hadir[] = intval($s->hadir);
            $izin[] = intval($s->izin);
            $sakit[] = intval($s->sakit);
            $cuti[] = intval($s->cuti);
            $sppd[] = intval($s->sppd);
            $terlambat[] = intval($s->terlambat);
        }
        $line_chart_data['datasets'][] = ['label' => 'Hadir', 'data' => $hadir, 'color' => '48bb78'];
        $line_chart_data['datasets'][] = ['label' => 'Izin', 'data' => $izin, 'color' => '667eea'];
        $line_chart_data['datasets'][] = ['label' => 'Sakit', 'data' => $sakit, 'color' => 'ecc94b'];
        $line_chart_data['datasets'][] = ['label' => 'Cuti', 'data' => $cuti, 'color' => '4299e1'];
        $line_chart_data['datasets'][] = ['label' => 'SPPD', 'data' => $sppd, 'color' => 'ADFF2F'];
        $line_chart_data['datasets'][] = ['label' => 'Terlambat', 'data' => $terlambat, 'color' => 'f56565'];

        // GRAFIK HARIAN
        $data = \DB::select("SELECT
                sum(if(jenis='h',1,0)) as hadir,
                sum(if(jenis='i',1,0)) as izin,
                sum(if(jenis='s',1,0)) as sakit,
                sum(if(jenis='c',1,0)) as cuti,
                sum(if(jenis='d',1,0)) as sppd,
                sum(if(jenis='t',1,0)) as terlambat
                FROM presensi " . $join . "
                WHERE waktu LIKE :tgl", ['tgl' => date('Y-m-d') . '%'])[0];

        $bar_chart_data['labels'] = ['Hadir', 'Izin', 'Sakit', 'Cuti', 'SPPD', 'Terlambat'];
        $bar_chart_data['data'] = [intval($data->hadir), intval($data->izin), intval($data->sakit), intval($data->cuti), intval($data->sppd), intval($data->terlambat)];
        $bar_chart_data['color'] = ['#48bb78', '#667eea', '#ecc94b', '#4299e1', '#ADFF2F', '#f56565'];

        return view('livewire.dashboard.grafik-presensi', [
            'lcdata' => $line_chart_data,
            'bcdata' => $bar_chart_data
        ]);
    }
}
