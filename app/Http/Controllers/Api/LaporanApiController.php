<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BeliAc;
use App\Models\JualAc;
use App\Models\ServiceAc;
use Illuminate\Http\Request;

class LaporanApiController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'tanggal_awal' => ['nullable', 'date'],
            'tanggal_akhir' => ['nullable', 'date'],
        ]);

        $tanggalAwal = $data['tanggal_awal'] ?? null;
        $tanggalAkhir = $data['tanggal_akhir'] ?? null;

        $beliAc = BeliAc::query()
            ->when($tanggalAwal, function ($query) use ($tanggalAwal) {
                $query->whereDate('tanggal', '>=', $tanggalAwal);
            })
            ->when($tanggalAkhir, function ($query) use ($tanggalAkhir) {
                $query->whereDate('tanggal', '<=', $tanggalAkhir);
            })
            ->orderBy('tanggal', 'desc')
            ->get();

        $jualAc = JualAc::query()
            ->when($tanggalAwal, function ($query) use ($tanggalAwal) {
                $query->whereDate('tanggal', '>=', $tanggalAwal);
            })
            ->when($tanggalAkhir, function ($query) use ($tanggalAkhir) {
                $query->whereDate('tanggal', '<=', $tanggalAkhir);
            })
            ->orderBy('tanggal', 'desc')
            ->get();

        $serviceAc = ServiceAc::query()
            ->when($tanggalAwal, function ($query) use ($tanggalAwal) {
                $query->whereDate('tanggal_awal', '>=', $tanggalAwal);
            })
            ->when($tanggalAkhir, function ($query) use ($tanggalAkhir) {
                $query->whereDate('tanggal_awal', '<=', $tanggalAkhir);
            })
            ->orderBy('tanggal_awal', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Data laporan berhasil diambil.',
            'filter' => [
                'tanggal_awal' => $tanggalAwal,
                'tanggal_akhir' => $tanggalAkhir,
            ],
            'ringkasan' => [
                'jumlah_data_beli_ac' => $beliAc->count(),
                'jumlah_data_jual_ac' => $jualAc->count(),
                'jumlah_data_service_ac' => $serviceAc->count(),
                'total_beli_ac' => $beliAc->sum('total_harga'),
                'total_jual_ac' => $jualAc->sum('total_harga'),
                'total_service_ac' => $serviceAc->sum('total_harga'),
                'total_semua_transaksi' => $beliAc->sum('total_harga') + $jualAc->sum('total_harga') + $serviceAc->sum('total_harga'),
            ],
            'data' => [
                'beli_ac' => $beliAc,
                'jual_ac' => $jualAc,
                'service_ac' => $serviceAc,
            ],
        ]);
    }
}
