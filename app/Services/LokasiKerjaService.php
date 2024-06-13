<?php

namespace App\Services;

use App\Models\Lokasi;

class LokasiKerjaService
{
    public function getData($id = null)
    {
        return $id === null ? Lokasi::all() : Lokasi::find($id);
    }
    public function storeData($data)
    {
        Lokasi::create($data);
    }
    public function updateData($id, $data)
    {
        return Lokasi::find($id)->update($data);
    }
    public function destroyData($id)
    {
        return Lokasi::find($id)->delete();
    }
}
