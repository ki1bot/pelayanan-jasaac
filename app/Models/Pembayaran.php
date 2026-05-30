<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_pesanan',
        'metode_pembayaran',
        'status_pembayaran',
        'bukti_pembayaran',
    ];
}
