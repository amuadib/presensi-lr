<?php

namespace App\Services;

use App\Models\Jam;

class JamKerjaService
{
    public function getData($id = null)
    {
        return $id === null ? Jam::all() : Jam::find($id);
    }
    public function storeData($data)
    {
        $data['jam'] = $this->validasiJam($data['jam']);
        Jam::create($data);
    }
    public function updateData($id, $data)
    {
        $data['jam'] = $this->validasiJam($data['jam']);
        return Jam::find($id)->update($data);
    }
    public function destroyData($id)
    {
        return Jam::find($id)->delete();
    }

    private function validasiJam($jam)
    {
        $tmp = [];
        foreach ($jam as $j) {
            if (
                $this->isJamValid($j['datang']) and
                $this->isJamValid($j['pulang']) and
                $this->isJamKerjaValid($j['datang'], $j['pulang'])
            ) {
                $tmp[] = $j;
            } else {
                $tmp[] = [
                    'hari' => $j['hari'],
                    'datang' => '',
                    'pulang' => '',
                ];
            }
        }

        return $tmp;
    }

    private function isJamValid($jam)
    {
        return preg_match('#^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$#', $jam . ':00');
    }

    private function isJamKerjaValid($datang, $pulang)
    {
        return strtotime(date('Y-m-d ' . $datang . ':00')) < strtotime(date('Y-m-d ' . $pulang . ':00'));
    }
}
