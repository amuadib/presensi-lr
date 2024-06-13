<?php

namespace App\Console\Commands;

use App\Models\Jam;
use App\Models\Presensi;
use Illuminate\Console\Command;

class fixTerlambat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'presensi:fix_terlambat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix keterangan terlambat';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $jam = [];
        $terlambat = [];
        $success = 0;
        foreach (Jam::all() as $j) {
            $jam[$j->id] = $j->jam;
        }

        foreach (Presensi::where('jenis', 'h')->get() as $p) {
            $hari = date('w', strtotime($p->waktu));
            $tanggal = explode(' ', $p->waktu)[0];
            // echo $tanggal;
            $jam_datang = $jam[$p->jam_id][$hari]['datang'] . ':00';
            if (strtotime($p->waktu) > strtotime($tanggal . ' ' . $jam_datang)) {
                // echo 'Terlambat: ' . timeDiff(strtotime($p->waktu), strtotime($tanggal . ' ' . $jam_datang)) . ' Datang: ' . $p->waktu . ' Masuk: ' . $tanggal . ' ' . $jam_datang;
                // echo PHP_EOL;
                $terlambat[$p->id] = [
                    'jenis' => 't',
                    'keterangan' => 'Terlambat ' . timeDiff(strtotime($p->waktu), strtotime($tanggal . ' ' . $jam_datang))
                ];
            }
        }
        if (count($terlambat) > 0) {
            foreach ($terlambat as $id => $update) {
                if (Presensi::find($id)->update($update)) {
                    $success++;
                }
            }
        }
        if ($success > 0 and count($terlambat) > 0) {
            echo ' Ditemukan data keterlambatan sebanyak ' . count($terlambat) . ', ' . $success . ' data berhasil diperbaiki';
        } else {
            echo ' Semua data sudah valid !';
        }
        // echo '[' . date('Y-m-d H:i:s') . '] Proses selesai.' . PHP_EOL;
    }
}
