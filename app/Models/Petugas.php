<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $guarded = [];

    protected $casts = [
        'blacklist_kode_pulang' => 'array',
    ];

    public function unit()
    {
        return $this->belongsTo('App\Models\UnitKerja', 'unit_kerja_id');
    }
}
