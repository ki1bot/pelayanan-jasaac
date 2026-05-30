<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BeliAc;
use App\Models\HargaBeliAc;
use App\Models\HargaJualAc;
use App\Models\HargaServiceAc;
use App\Models\HubungiKami;
use App\Models\JualAc;
use App\Models\LoginAc;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use App\Models\PusatService;
use App\Models\ServiceAc;
use Illuminate\Http\Request;

class AdminApiController extends Controller
{
    public function index(string $jenis)
    {
        $model = $this->model($jenis);

        return response()->json($model::latest()->paginate(10));
    }

    public function store(Request $request, string $jenis)
    {
        $model = $this->model($jenis);
        $data = $request->all();

        $item = $model::create($data);

        return response()->json([
            'message' => 'Data berhasil ditambahkan.',
            'data' => $item,
        ], 201);
    }

    public function update(Request $request, string $jenis, int $id)
    {
        $model = $this->model($jenis);
        $item = $model::findOrFail($id);
        $item->update($request->all());

        return response()->json([
            'message' => 'Data berhasil diperbarui.',
            'data' => $item,
        ]);
    }

    public function destroy(string $jenis, int $id)
    {
        $model = $this->model($jenis);
        $item = $model::findOrFail($id);
        $item->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus.',
        ]);
    }

    private function model(string $jenis): string
    {
        $map = [
            'loginac' => LoginAc::class,
            'hubungikami' => HubungiKami::class,
            'pusatservice' => PusatService::class,
            'hargabeliac' => HargaBeliAc::class,
            'hargajualac' => HargaJualAc::class,
            'hargaserviceac' => HargaServiceAc::class,
            'beliac' => BeliAc::class,
            'jualac' => JualAc::class,
            'serviceac' => ServiceAc::class,
            'pesanan' => Pesanan::class,
            'pembayaran' => Pembayaran::class,
        ];

        abort_unless(isset($map[$jenis]), 404);

        return $map[$jenis];
    }
}
