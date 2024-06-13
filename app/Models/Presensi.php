<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';
    protected $guarded = [];
    public $timestamps = false;

    public function absenable()
    {
        return $this->morphTo();
    }
    public function jam_kerja()
    {
        return $this->belongsTo(Jam::class, 'jam_id');
    }
}
