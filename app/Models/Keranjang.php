<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';

    protected $primaryKey = 'id_keranjang';

    protected $fillable = [
        'id_login',
        'jenis_pesanan',
        'id_harga',
        'nama_item',
        'nama_pemesan',
        'jenis_kelamin',
        'telepon',
        'lokasi',
        'jumlah',
        'harga_satuan',
        'jarak_km',
        'biaya_jarak',
        'total_harga',
        'detail',
    ];

    protected $casts = [
        'id_login' => 'integer',
        'id_harga' => 'integer',
        'jumlah' => 'integer',
        'harga_satuan' => 'decimal:2',
        'jarak_km' => 'decimal:2',
        'biaya_jarak' => 'decimal:2',
        'total_harga' => 'decimal:2',
        'detail' => 'array',
    ];

    public function login()
    {
        return $this->belongsTo(LoginAc::class, 'id_login', 'id_login');
    }

    public function getJenisAttribute()
    {
        return $this->jenis_pesanan;
    }

    public function getDataDetailAttribute()
    {
        return $this->detail ?? [];
    }
}
