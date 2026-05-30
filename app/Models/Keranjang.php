<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id_keranjang';

    protected $fillable = [
        'id_login',
        'jenis',
        'id_harga',
        'nama_item',
        'lokasi',
        'jumlah',
        'harga_satuan',
        'jarak_km',
        'biaya_jarak',
        'total_harga',
        'data_detail',
    ];

    protected $casts = [
        'data_detail' => 'array',
    ];
}
