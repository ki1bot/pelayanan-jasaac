<?php

namespace App\Http\Controllers;

use App\Models\BeliAc;
use App\Models\HargaBeliAc;
use App\Models\HargaJualAc;
use App\Models\HargaServiceAc;
use App\Models\HubungiKami;
use App\Models\JualAc;
use App\Models\Keranjang;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use App\Models\PusatService;
use App\Models\ServiceAc;
use Illuminate\Http\Request;

class HalamanController extends Controller
{
    public function beranda()
    {
        $jumlahBeli = BeliAc::query()->count();
        $jumlahJual = JualAc::query()->count();
        $jumlahService = ServiceAc::query()->count();
        $jumlahKeranjang = Keranjang::query()->count();
        $jumlahPesanan = Pesanan::query()->count();
        $jumlahPembayaran = Pembayaran::query()->count();

        $totalBeli = BeliAc::query()->sum('total_harga');
        $totalJual = JualAc::query()->sum('total_harga');
        $totalService = ServiceAc::query()->sum('total_harga');
        $totalSemua = $totalBeli + $totalJual + $totalService;

        $maksimalTransaksi = max($jumlahBeli, $jumlahJual, $jumlahService, 1);

        $persenBeli = round(($jumlahBeli / $maksimalTransaksi) * 100);
        $persenJual = round(($jumlahJual / $maksimalTransaksi) * 100);
        $persenService = round(($jumlahService / $maksimalTransaksi) * 100);

        $pusatService = PusatService::query()->first(['*']);

        return view('halaman.halaman', compact(
            'jumlahBeli',
            'jumlahJual',
            'jumlahService',
            'jumlahKeranjang',
            'jumlahPesanan',
            'jumlahPembayaran',
            'totalBeli',
            'totalJual',
            'totalService',
            'totalSemua',
            'persenBeli',
            'persenJual',
            'persenService',
            'pusatService'
        ));
    }

    public function beli()
    {
        $hargaBeli = HargaBeliAc::query()
            ->orderBy('nama_merkac', 'asc')
            ->get();

        return view('transaksi.beli', compact('hargaBeli'));
    }

    public function jual()
    {
        $hargaJual = HargaJualAc::query()
            ->orderBy('nama_merkac', 'asc')
            ->get();

        return view('transaksi.jual', compact('hargaJual'));
    }

    public function service()
    {
        $hargaService = HargaServiceAc::query()
            ->orderBy('keterangan_ac', 'asc')
            ->get();

        return view('transaksi.service', compact('hargaService'));
    }

    public function hargaBeli()
    {
        $hargaBeli = HargaBeliAc::query()
            ->orderBy('nama_merkac', 'asc')
            ->get();

        return view('halaman.harga-beli', compact('hargaBeli'));
    }

    public function hargaJual()
    {
        $hargaJual = HargaJualAc::query()
            ->orderBy('nama_merkac', 'asc')
            ->get();

        return view('halaman.harga-jual', compact('hargaJual'));
    }

    public function hargaService()
    {
        $hargaService = HargaServiceAc::query()
            ->orderBy('keterangan_ac', 'asc')
            ->get();

        return view('halaman.harga-service', compact('hargaService'));
    }

    public function tentang()
    {
        return view('halaman.tentang');
    }

    public function kontak()
    {
        return view('halaman.kontak');
    }

    public function simpanKontak(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'subjek' => ['required', 'string', 'max:150'],
            'pesan' => ['required', 'string'],
        ]);

        HubungiKami::query()->create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'subjek' => $data['subjek'],
            'pesan' => $data['pesan'],
            'tanggal' => now(),
        ]);

        return back()->with('success', 'Pesan berhasil dikirim.');
    }
}
