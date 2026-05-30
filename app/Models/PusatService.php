<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PusatService extends Model
{
    protected $table = 'pusatservice';
    protected $primaryKey = 'id_pusat';

    protected $fillable = [
        'lokasi_pusat',
    ];
}
