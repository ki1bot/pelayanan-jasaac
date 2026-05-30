<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaServiceAc extends Model
{
    protected $table = 'hargaserviceac';
    protected $primaryKey = 'id_hargaservice';

    protected $fillable = [
        'keterangan_ac',
        'harga',
    ];
}
