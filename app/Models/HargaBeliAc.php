<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaBeliAc extends Model
{
    protected $table = 'hargabeliac';
    protected $primaryKey = 'id_hargabeli';

    protected $fillable = [
        'nama_merkac',
        'harga',
    ];
}
