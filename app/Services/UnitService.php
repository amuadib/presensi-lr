<?php

namespace App\Services;

use App\Models\UnitKerja;

class UnitService
{
    public function getData($id = null)
    {
        return $id === null ? UnitKerja::all() : UnitKerja::find($id);
    }
    public function storeData($data)
    {
        UnitKerja::create($data);
    }
    public function updateData($id, $data)
    {
        return UnitKerja::find($id)->update($data);
    }
    public function destroyData($id)
    {
        return UnitKerja::find($id)->delete();
    }
}
