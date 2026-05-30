<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceAc extends Model
{
    protected $table = 'serviceac';
    protected $primaryKey = 'id_service';

    protected $fillable = [
        'id_hargaservice',
        'nama_client',
        'jenis_kelamin',
        'telp_client',
        'lokasi_client',
        'keterangan_ac',
        'tanggal_awal',
        'tanggal_akhir',
        'metode_pembayaran',
        'jarak_km',
        'biaya_jarak',
        'total_harga',
    ];

    public function harga()
    {
        return $this->belongsTo(HargaServiceAc::class, 'id_hargaservice', 'id_hargaservice');
    }
}
