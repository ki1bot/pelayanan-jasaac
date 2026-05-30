<?php

namespace App\Http\Controllers;

use App\Models\BeliAc;
use App\Models\HargaBeliAc;
use App\Models\HargaJualAc;
use App\Models\HargaServiceAc;
use App\Models\JualAc;
use App\Models\PusatService;
use App\Models\ServiceAc;
use App\Services\HitungHargaAcService;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function formBeli()
    {
        return $this->tampilkanHalaman('beli');
    }

    public function formJual()
    {
        return $this->tampilkanHalaman('jual');
    }

    public function formService()
    {
        return $this->tampilkanHalaman('service');
    }

    public function storeBeli(Request $request, HitungHargaAcService $hitungHarga)
    {
        $data = $request->validate([
            'id_hargabeli' => ['required', 'exists:hargabeliac,id_hargabeli'],
            'nama_pembeli' => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', 'string', 'max:20'],
            'lokasi' => ['required', 'string', 'max:150'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'tanggal' => ['required', 'date'],
            'metode_pembayaran' => ['required', 'string', 'max:100'],
            'metode_pengiriman' => ['required', 'string', 'max:100'],
            'jarak_km' => ['required', 'numeric', 'min:0'],
        ]);

        $harga = HargaBeliAc::query()->findOrFail($data['id_hargabeli']);
        $hasil = $hitungHarga->hitung((float) $harga->harga, (int) $data['jumlah'], (float) $data['jarak_km']);

        BeliAc::query()->create([
            'id_hargabeli' => $harga->id_hargabeli,
            'nama_pembeli' => $data['nama_pembeli'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'merk_ac' => $harga->nama_merkac,
            'lokasi' => $data['lokasi'],
            'jumlah' => $data['jumlah'],
            'tanggal' => $data['tanggal'],
            'metode_pembayaran' => $data['metode_pembayaran'],
            'metode_pengiriman' => $data['metode_pengiriman'],
            'jarak_km' => $hasil['jarak_km'],
            'biaya_jarak' => $hasil['biaya_jarak'],
            'total_harga' => $hasil['total_harga'],
        ]);

        return redirect()->route('laporan.index')->with('success', 'Data pembelian AC berhasil disimpan.');
    }

    public function storeJual(Request $request, HitungHargaAcService $hitungHarga)
    {
        $data = $request->validate([
            'id_hargajual' => ['required', 'exists:hargajualac,id_hargajual'],
            'nama_penjual' => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', 'string', 'max:20'],
            'lokasi' => ['required', 'string', 'max:150'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'tanggal' => ['required', 'date'],
            'metode_pembayaran' => ['required', 'string', 'max:100'],
            'metode_pengiriman' => ['required', 'string', 'max:100'],
            'jarak_km' => ['required', 'numeric', 'min:0'],
        ]);

        $harga = HargaJualAc::query()->findOrFail($data['id_hargajual']);
        $hasil = $hitungHarga->hitung((float) $harga->harga, (int) $data['jumlah'], (float) $data['jarak_km']);

        JualAc::query()->create([
            'id_hargajual' => $harga->id_hargajual,
            'nama_penjual' => $data['nama_penjual'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'merk_ac' => $harga->nama_merkac,
            'lokasi' => $data['lokasi'],
            'jumlah' => $data['jumlah'],
            'tanggal' => $data['tanggal'],
            'metode_pembayaran' => $data['metode_pembayaran'],
            'metode_pengiriman' => $data['metode_pengiriman'],
            'jarak_km' => $hasil['jarak_km'],
            'biaya_jarak' => $hasil['biaya_jarak'],
            'total_harga' => $hasil['total_harga'],
        ]);

        return redirect()->route('laporan.index')->with('success', 'Data penjualan AC berhasil disimpan.');
    }

    public function storeService(Request $request, HitungHargaAcService $hitungHarga)
    {
        $data = $request->validate([
            'id_hargaservice' => ['required', 'exists:hargaserviceac,id_hargaservice'],
            'nama_client' => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', 'string', 'max:20'],
            'telp_client' => ['required', 'string', 'max:20'],
            'lokasi_client' => ['required', 'string', 'max:150'],
            'tanggal_awal' => ['required', 'date'],
            'tanggal_akhir' => ['required', 'date', 'after_or_equal:tanggal_awal'],
            'metode_pembayaran' => ['required', 'string', 'max:100'],
            'jarak_km' => ['required', 'numeric', 'min:0'],
        ]);

        $harga = HargaServiceAc::query()->findOrFail($data['id_hargaservice']);
        $hasil = $hitungHarga->hitung((float) $harga->harga, 1, (float) $data['jarak_km']);

        ServiceAc::query()->create([
            'id_hargaservice' => $harga->id_hargaservice,
            'nama_client' => $data['nama_client'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'telp_client' => $data['telp_client'],
            'lokasi_client' => $data['lokasi_client'],
            'keterangan_ac' => $harga->keterangan_ac,
            'tanggal_awal' => $data['tanggal_awal'],
            'tanggal_akhir' => $data['tanggal_akhir'],
            'metode_pembayaran' => $data['metode_pembayaran'],
            'jarak_km' => $hasil['jarak_km'],
            'biaya_jarak' => $hasil['biaya_jarak'],
            'total_harga' => $hasil['total_harga'],
        ]);

        return redirect()->route('laporan.index')->with('success', 'Data service AC berhasil disimpan.');
    }

    private function tampilkanHalaman(string $mode)
    {
        $hargaBeli = HargaBeliAc::query()
            ->orderBy('nama_merkac', 'asc')
            ->get();

        $hargaJual = HargaJualAc::query()
            ->orderBy('nama_merkac', 'asc')
            ->get();

        $hargaService = HargaServiceAc::query()
            ->orderBy('keterangan_ac', 'asc')
            ->get();

        $pusatService = PusatService::query()
            ->first(['*']);

        return view('halaman.halaman', compact(
            'hargaBeli',
            'hargaJual',
            'hargaService',
            'pusatService',
            'mode'
        ));
    }
}
