<?php

namespace App\Http\Controllers;

use App\Models\BeliAc;
use App\Models\JualAc;
use App\Models\ServiceAc;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $beliAc = BeliAc::with('harga')
            ->when($tanggalAwal, fn ($query) => $query->whereDate('tanggal', '>=', $tanggalAwal))
            ->when($tanggalAkhir, fn ($query) => $query->whereDate('tanggal', '<=', $tanggalAkhir))
            ->latest('tanggal')
            ->get();

        $jualAc = JualAc::with('harga')
            ->when($tanggalAwal, fn ($query) => $query->whereDate('tanggal', '>=', $tanggalAwal))
            ->when($tanggalAkhir, fn ($query) => $query->whereDate('tanggal', '<=', $tanggalAkhir))
            ->latest('tanggal')
            ->get();

        $serviceAc = ServiceAc::with('harga')
            ->when($tanggalAwal, fn ($query) => $query->whereDate('tanggal_awal', '>=', $tanggalAwal))
            ->when($tanggalAkhir, fn ($query) => $query->whereDate('tanggal_awal', '<=', $tanggalAkhir))
            ->latest('tanggal_awal')
            ->get();

        $totalBeli = $beliAc->sum('total_harga');
        $totalJual = $jualAc->sum('total_harga');
        $totalService = $serviceAc->sum('total_harga');

        return view('laporan.laporan', compact(
            'beliAc',
            'jualAc',
            'serviceAc',
            'totalBeli',
            'totalJual',
            'totalService',
            'tanggalAwal',
            'tanggalAkhir'
        ));
    }
}
