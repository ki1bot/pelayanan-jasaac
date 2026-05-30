<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JualAc extends Model
{
    protected $table = 'jualac';
    protected $primaryKey = 'id_jual';

    protected $fillable = [
        'id_hargajual',
        'nama_penjual',
        'jenis_kelamin',
        'merk_ac',
        'lokasi',
        'jumlah',
        'tanggal',
        'metode_pembayaran',
        'metode_pengiriman',
        'jarak_km',
        'biaya_jarak',
        'total_harga',
    ];

    public function harga()
    {
        return $this->belongsTo(HargaJualAc::class, 'id_hargajual', 'id_hargajual');
    }
}
