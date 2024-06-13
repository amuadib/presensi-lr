<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';
    protected $guarded = [];

    public function isPhotoLocked()
    {
        return $this->kunci_foto == 'y' && ($this->foto != '' && $this->foto != 'not-found.jpg');
    }
    public function unit()
    {
        return $this->belongsTo('App\Models\UnitKerja', 'unit_kerja_id');
    }
    public function pembagian()
    {
        return $this->morphMany('App\Models\Pembagian', 'absenable');
    }
}
