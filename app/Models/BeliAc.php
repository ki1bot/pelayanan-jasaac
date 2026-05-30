<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeliAc extends Model
{
    protected $table = 'beliac';
    protected $primaryKey = 'id_beli';

    protected $fillable = [
        'id_hargabeli',
        'nama_pembeli',
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
        return $this->belongsTo(HargaBeliAc::class, 'id_hargabeli', 'id_hargabeli');
    }
}
