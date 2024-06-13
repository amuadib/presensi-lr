<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'authable_type',
        'authable_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function authable()
    {
        return $this->morphTo();
    }

    public function hasUnitKerja()
    {
        return $this->authable->unit;
    }

    public function isAdmin()
    {
        return strpos($this->authable_type, "Admin");
    }

    public function jenis_akun()
    {
        return strpos($this->authable_type, "Admin") ? "a" : (strpos($this->authable_type, "Anggota") ? "b" : "p");
    }

    public function role()
    {
        return strpos($this->authable_type, "Admin") ? "Admin" : (strpos($this->authable_type, "Anggota") ? "Anggota" : "Petugas");
    }
    public function isImpersonating()
    {
        return \Session::has('orig_user');
    }
}
