<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    protected $table = 'jam';
    protected $guarded = [];
    public $timestamps = false;
    protected $casts = [
        'jam' => 'array',
    ];
}
