<?php

namespace App\Services;

use App\Models\Anggota;
use App\Models\Jam;
use App\Models\Presensi;

class RekapService
{
    public $jam;
    protected $jenis = [
        'h' => 'Hadir',
        't' => 'Terlambat',
        'i' => 'Izin',
        's' => 'Sakit',
        'c' => 'Cuti',
        'd' => 'SPPD',
        'p' => 'Pulang'
    ];
    public function getDetail($id, $awal, $akhir)
    {
        $data = [];
        $mulai = null;
        $user = \Auth::user();

        foreach (Presensi::where('absenable_id', $id)
            // ->where('absenable_type', 'App\\Models\\Anggota')
            ->when($user->role() == 'Petugas', function ($w) use ($user) {
                $w
                    ->join('anggota', function ($j) use ($user) {
                        $j
                            ->on('anggota.id', '=', 'absenable_id')
                            ->where('anggota.unit_kerja_id', '=', $user->authable->unit_kerja_id);
                    });
            })
            ->whereRaw('date(waktu) between "' . $awal . '" AND "' . $akhir . '"')
            ->orderBy('waktu')
            ->get() as $d) {
            $date = explode(' ', $d->waktu)[0];
            if ($mulai == null) {
                $mulai = date('w', strtotime($d->waktu));
            }
            if (isset($data[$date])) {
                $data[$date]['jenis2'] = $this->jenis[$d->jenis];
                $data[$date]['waktu2'] = explode(' ', $d->waktu)[1];
            } else {
                $data[$date] = [
                    'jenis' => $this->jenis[$d->jenis],
                    'jenis2' => '',
                    'waktu' => explode(' ', $d->waktu)[1],
                    'waktu2' => ''
                ];
            }
        }
        return [
            'nama' => Anggota::find($id)->nama,
            'mulai' => intval($mulai),
            'data' => $data
        ];
    }

    public function getData($awal, $akhir)
    {
        $this->cekPresensiPulang();

        $this->jam = $this->getJamKerja();
        $tunjangan = config('custom.tunjangan');
        $data = [];

        $user = \Auth::user();
        $rekap = Presensi::with('absenable')
            ->when($user->role() == 'Petugas', function ($w) use ($user) {
                $w
                    ->join('anggota', function ($j) use ($user) {
                        $j
                            ->on('anggota.id', '=', 'absenable_id')
                            ->where('anggota.unit_kerja_id', '=', $user->authable->unit_kerja_id);
                    });
            })
            ->whereRaw("DATE(waktu) BETWEEN '" . $awal . "' AND '" . $akhir . "'")
            ->selectRaw("sum(if(jenis='h',1,0)) as hadir,
        sum(if(jenis='i',1,0)) as izin,
        sum(if(jenis='p',1,0)) as pulang,
        sum(if(jenis='s',1,0)) as sakit,
        sum(if(jenis='c',1,0)) as cuti,
        sum(if(jenis='d',1,0)) as sppd,
        sum(if(jenis='t',1,0)) as terlambat,
        absenable_id, absenable_type,
        jam_id,waktu
       ")
            ->groupBy('absenable_type')
            ->groupBy('absenable_id')
            ->get();
        if ($rekap->count()) {
            $cek_terlambat_id = [];
            foreach ($rekap as $r) {
                $total = intval($r->hadir) + intval($r->terlambat);
                if ($r->terlambat > 0) {
                    $cek_terlambat_id[] = $r->absenable_id;
                }
                $data[$r->absenable_id] = [
                    'nama' => $r->absenable->nama ?? 'Deleted user ' . $r->absenable_id,
                    'hadir' => $r->hadir,
                    't_hadir' => formatRupiah($r->hadir * $tunjangan['ontime']),
                    'terlambat' => $r->terlambat,
                    't_terlambat' => formatRupiah($r->terlambat * $tunjangan['terlambat']),
                    'total' => $total,
                    'pulang' => $r->pulang,
                    'lp_pulang' => $total - $r->pulang,
                    't_lp_pulang' => formatRupiah($tunjangan['lupa'] * ($total - intval($r->pulang))),
                    'sakit' => $r->sakit,
                    'izin' => $r->izin,
                    'cuti' => $r->cuti,
                    'sppd' => $r->sppd,
                    'total_presensi' => intval($r->hadir) +
                        intval($r->izin) +
                        intval($r->sakit) +
                        intval($r->cuti) +
                        intval($r->sppd) +
                        intval($r->terlambat),
                    'total_tunjangan' => formatRupiah(
                        $r->hadir * $tunjangan['ontime'] +
                            $r->terlambat * $tunjangan['ontime'] -
                            $r->terlambat * $tunjangan['terlambat'] -
                            $tunjangan['lupa'] * (intval($r->hadir) + intval($r->terlambat) - intval($r->pulang)),
                    )
                ];
            }
        }
        return $data;
    }

    public function getPulangAwal($awal, $akhir)
    {
        $pulang_awal = [];

        $user = \Auth::user();
        foreach (Presensi::when($user->role() == 'Petugas', function ($w) use ($user) {
            $w
                ->join('anggota', function ($j) use ($user) {
                    $j
                        ->on('anggota.id', '=', 'absenable_id')
                        ->where('anggota.unit_kerja_id', '=', $user->authable->unit_kerja_id);
                });
        })
            ->whereRaw("DATE(waktu) BETWEEN '" . $awal . "' AND '" . $akhir . "'")
            ->where('jenis', 'p')
            ->get() as $p) {
            $hari = date('w', strtotime($p->waktu));
            $jadwal = $this->jam[$p->jam_id][$hari];
            $waktu = explode(' ', $p->waktu);

            if (strtotime($p->waktu) < strtotime($waktu[0] . ' ' . $jadwal['pulang'] . ':00')) {
                $diff = $this->diffInMinutes(strtotime($waktu[0] . ' ' . $jadwal['pulang'] . ':00'), strtotime($p->waktu));

                if ($diff >= 1 && $diff <= 10) {
                    if (isset($pulang_awal[$p->absenable_id]['a1'])) {
                        $pulang_awal[$p->absenable_id]['a1']++;
                    } else {
                        $pulang_awal[$p->absenable_id]['a1'] = 1;
                    }
                } elseif ($diff >= 11 && $diff <= 30) {
                    if (isset($pulang_awal[$p->absenable_id]['a2'])) {
                        $pulang_awal[$p->absenable_id]['a2']++;
                    } else {
                        $pulang_awal[$p->absenable_id]['a2'] = 1;
                    }
                } else {
                    if (isset($pulang_awal[$p->absenable_id]['a3'])) {
                        $pulang_awal[$p->absenable_id]['a3']++;
                    } else {
                        $pulang_awal[$p->absenable_id]['a3'] = 1;
                    }
                }

                if (isset($pulang_awal[$p->absenable_id]['an'])) {
                    $pulang_awal[$p->absenable_id]['an']++;
                } else {
                    $pulang_awal[$p->absenable_id]['an'] = 1;
                }
            } else {
                //Tepat Waktu
                if (isset($pulang_awal[$p->absenable_id]['a0'])) {
                    $pulang_awal[$p->absenable_id]['a0']++;
                } else {
                    $pulang_awal[$p->absenable_id]['a0'] = 1;
                }
            }
        }
        return $pulang_awal;
    }
    public function getTerlambat($awal, $akhir)
    {
        $terlambat = [];

        $user = \Auth::user();
        foreach (Presensi::when($user->role() == 'Petugas', function ($w) use ($user) {
            $w
                ->join('anggota', function ($j) use ($user) {
                    $j
                        ->on('anggota.id', '=', 'absenable_id')
                        ->where('anggota.unit_kerja_id', '=', $user->authable->unit_kerja_id);
                });
        })
            ->whereRaw("DATE(waktu) BETWEEN '" . $awal . "' AND '" . $akhir . "'")
            ->where('jenis', 't')
            ->get() as $p) {
            $hari = date('w', strtotime($p->waktu));
            $jadwal = $this->jam[$p->jam_id][$hari];
            $waktu = explode(' ', $p->waktu);
            $diff = $this->diffInMinutes(strtotime($waktu[0] . ' ' . $jadwal['datang'] . ':00'), strtotime($p->waktu));

            if ($diff >= 1 && $diff <= 10) {
                if (isset($terlambat[$p->absenable_id]['t1'])) {
                    $terlambat[$p->absenable_id]['t1']++;
                } else {
                    $terlambat[$p->absenable_id]['t1'] = 1;
                }
            } elseif ($diff >= 11 && $diff <= 30) {
                if (isset($terlambat[$p->absenable_id]['t2'])) {
                    $terlambat[$p->absenable_id]['t2']++;
                } else {
                    $terlambat[$p->absenable_id]['t2'] = 1;
                }
            } else {
                if (isset($terlambat[$p->absenable_id]['t3'])) {
                    $terlambat[$p->absenable_id]['t3']++;
                } else {
                    $terlambat[$p->absenable_id]['t3'] = 1;
                }
            }
        }
        return $terlambat;
    }
    private function diffInMinutes($t1, $t2)
    {
        $sec = $t1 > $t2 ? $t1 - $t2 : $t2 - $t1;
        return  intval(floor($sec / 60));
    }
    private function getJamKerja()
    {
        $data = [];
        foreach (Jam::all() as $j) {
            $data[$j->id] = $j->jam;
        }
        return $data;
    }

    public function cekPresensiPulang()
    {
        if (time() < $this->getMulaiDatangPertama() || time() > $this->getBatasPulangTerakhir()) {
            //cek jika ada data presensi 'h' yang tidak diikuti 'p' pada tanggal yg sama
            if (count(\DB::select("
                SELECT id FROM presensi
                WHERE id IN(
                    SELECT id
                    FROM presensi
                    GROUP BY date(waktu), absenable_id, absenable_type
                    HAVING count(*) < 2
                )
                AND jenis = 'h' ")) > 0) {
                //UPDATE menjadi 't' jika ditemukan
                \DB::connection('presensi_spa')
                    ->statement("
                    UPDATE presensi
                    SET jenis = 't'
                    WHERE id IN(
                        SELECT id FROM presensi
                        WHERE id IN(
                            SELECT id
                            FROM presensi
                            GROUP BY date(waktu), absenable_id, absenable_type
                            HAVING count(*) < 2
                        )
                        AND jenis = 'h'
                    )
            ");
            }
        }
    }

    private function getMulaiDatangPertama()
    {
        return \Cache::get('jam_datang_' . date('Ymd'), function () {
            $jam_datang = 0;
            $hari = date('w');
            foreach (Jam::get() as $j) {
                $new = strtotime(date('Y-m-d ' . $j->jam[$hari]['datang']) . ':00') - ($j->batas_mulai_presensi * 60);
                if ($jam_datang == 0) {
                    $jam_datang = $new;
                } else {
                    if ($new < $jam_datang) {
                        $jam_datang = $new;
                    }
                }
            }

            if ($jam_datang > 0) {
                \Cache::put('jam_datang_' . date('Ymd'), $jam_datang, 60);
            }
            return $jam_datang;
        });
    }

    private function getBatasPulangTerakhir()
    {
        return \Cache::get('jam_pulang_' . date('Ymd'), function () {
            $jam_pulang = 0;
            $hari = date('w');
            foreach (Jam::get() as $j) {
                if ($j->jam != '') {
                    $new = strtotime(date('Y-m-d ' . $j->jam[$hari]['pulang']) . ':00') + ($j->batas_akhir_presensi * 60);
                    if ($new > $jam_pulang) {
                        $jam_pulang = $new;
                    }
                }
            }
            if ($jam_pulang > 0) {
                \Cache::put('jam_pulang_' . date('Ymd'), $jam_pulang, 60);
            }
            return $jam_pulang;
        });
    }
}
