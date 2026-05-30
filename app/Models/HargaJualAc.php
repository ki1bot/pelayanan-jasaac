<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaJualAc extends Model
{
    protected $table = 'hargajualac';
    protected $primaryKey = 'id_hargajual';

    protected $fillable = [
        'nama_merkac',
        'harga',
    ];
}
