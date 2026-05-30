<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HargaBeliAc;
use App\Models\HargaJualAc;
use App\Models\HargaServiceAc;

class HargaApiController extends Controller
{
    public function hargaBeli()
    {
        $data = HargaBeliAc::query()
            ->orderBy('nama_merkac', 'asc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Data harga beli AC berhasil diambil.',
            'data' => $data,
        ]);
    }

    public function hargaJual()
    {
        $data = HargaJualAc::query()
            ->orderBy('nama_merkac', 'asc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Data harga jual AC berhasil diambil.',
            'data' => $data,
        ]);
    }

    public function hargaService()
    {
        $data = HargaServiceAc::query()
            ->orderBy('keterangan_ac', 'asc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Data harga service AC berhasil diambil.',
            'data' => $data,
        ]);
    }
}
