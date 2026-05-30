<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class LoginAc extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'loginac';
    protected $primaryKey = 'id_login';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'username',
        'email',
        'password',
        'google_id',
        'facebook_id',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'id_login', 'id_login');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_login', 'id_login');
    }
}
