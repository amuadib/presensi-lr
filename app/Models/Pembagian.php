<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembagian extends Model
{
    protected $table = 'pembagian';
    protected $guarded = [];
    public $timestamps = false;

    public function absenable()
    {
        return $this->morphTo();
    }

    public function jam()
    {
        return $this->belongsTo(Jam::class, 'jam_id');
    }
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }
}
