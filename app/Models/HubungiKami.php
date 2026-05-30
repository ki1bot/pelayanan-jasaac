<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HubungiKami extends Model
{
    protected $table = 'hubungikami';
    protected $primaryKey = 'id_hubungi';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'subjek',
        'pesan',
        'tanggal',
    ];
}
