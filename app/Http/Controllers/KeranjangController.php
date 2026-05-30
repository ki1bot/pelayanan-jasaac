<?php

namespace App\Http\Controllers;

use App\Models\BeliAc;
use App\Models\HargaBeliAc;
use App\Models\HargaJualAc;
use App\Models\HargaServiceAc;
use App\Models\JualAc;
use App\Models\Keranjang;
use App\Models\LoginAc;
use App\Models\Pesanan;
use App\Models\ServiceAc;
use App\Services\HitungHargaAcService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KeranjangController extends Controller
{
    public function index()
    {
        $idLogin = (int) Auth::id();

        $keranjang = Keranjang::query()
            ->where('id_login', $idLogin)
            ->orderBy('created_at', 'desc')
            ->get();

        $total = $keranjang->sum('total_harga');

        return view('keranjang.keranjang', compact('keranjang', 'total'));
    }

    public function store(Request $request, HitungHargaAcService $hitungHarga)
    {
        $data = $request->validate([
            'jenis' => ['required', 'in:beli,jual,service'],
            'id_harga' => ['required', 'integer'],
            'lokasi' => ['required', 'string', 'max:150'],
            'jumlah' => ['nullable', 'integer', 'min:1'],
            'jarak_km' => ['required', 'numeric', 'min:0'],
            'data_detail' => ['nullable', 'array'],
        ]);

        $idLogin = (int) Auth::id();
        $jumlah = $data['jenis'] === 'service' ? 1 : (int) ($data['jumlah'] ?? 1);
        $item = $this->ambilHarga($data['jenis'], (int) $data['id_harga']);
        $hasil = $hitungHarga->hitung((float) $item['harga'], $jumlah, (float) $data['jarak_km']);

        Keranjang::query()->create([
            'id_login' => $idLogin,
            'jenis' => $data['jenis'],
            'id_harga' => $data['id_harga'],
            'nama_item' => $item['nama_item'],
            'lokasi' => $data['lokasi'],
            'jumlah' => $jumlah,
            'harga_satuan' => $hasil['harga_satuan'],
            'jarak_km' => $hasil['jarak_km'],
            'biaya_jarak' => $hasil['biaya_jarak'],
            'total_harga' => $hasil['total_harga'],
            'data_detail' => $data['data_detail'] ?? [],
        ]);

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil dimasukkan ke keranjang.');
    }

    public function destroy(int $id)
    {
        $idLogin = (int) Auth::id();

        $keranjang = Keranjang::query()
            ->where('id_login', $idLogin)
            ->where('id_keranjang', $id)
            ->firstOrFail(['*']);

        $keranjang->delete();

        return back()->with('success', 'Item keranjang berhasil dihapus.');
    }

    public function checkout()
    {
        $idLogin = (int) Auth::id();

        $user = LoginAc::query()
            ->findOrFail($idLogin);

        $keranjang = Keranjang::query()
            ->where('id_login', $idLogin)
            ->get();

        if ($keranjang->isEmpty()) {
            return back()->withErrors([
                'keranjang' => 'Keranjang masih kosong.',
            ]);
        }

        foreach ($keranjang as $item) {
            $detail = is_array($item->data_detail) ? $item->data_detail : [];

            if ($item->jenis === 'beli') {
                BeliAc::query()->create([
                    'id_hargabeli' => $item->id_harga,
                    'nama_pembeli' => $detail['nama_pembeli'] ?? $user->nama,
                    'jenis_kelamin' => $detail['jenis_kelamin'] ?? $user->jenis_kelamin,
                    'merk_ac' => $item->nama_item,
                    'lokasi' => $item->lokasi,
                    'jumlah' => $item->jumlah,
                    'tanggal' => now(),
                    'metode_pembayaran' => $detail['metode_pembayaran'] ?? 'belum dipilih',
                    'metode_pengiriman' => $detail['metode_pengiriman'] ?? 'belum dipilih',
                    'jarak_km' => $item->jarak_km,
                    'biaya_jarak' => $item->biaya_jarak,
                    'total_harga' => $item->total_harga,
                ]);
            }

            if ($item->jenis === 'jual') {
                JualAc::query()->create([
                    'id_hargajual' => $item->id_harga,
                    'nama_penjual' => $detail['nama_penjual'] ?? $user->nama,
                    'jenis_kelamin' => $detail['jenis_kelamin'] ?? $user->jenis_kelamin,
                    'merk_ac' => $item->nama_item,
                    'lokasi' => $item->lokasi,
                    'jumlah' => $item->jumlah,
                    'tanggal' => now(),
                    'metode_pembayaran' => $detail['metode_pembayaran'] ?? 'belum dipilih',
                    'metode_pengiriman' => $detail['metode_pengiriman'] ?? 'belum dipilih',
                    'jarak_km' => $item->jarak_km,
                    'biaya_jarak' => $item->biaya_jarak,
                    'total_harga' => $item->total_harga,
                ]);
            }

            if ($item->jenis === 'service') {
                ServiceAc::query()->create([
                    'id_hargaservice' => $item->id_harga,
                    'nama_client' => $detail['nama_client'] ?? $user->nama,
                    'jenis_kelamin' => $detail['jenis_kelamin'] ?? $user->jenis_kelamin,
                    'telp_client' => $detail['telp_client'] ?? '-',
                    'lokasi_client' => $item->lokasi,
                    'keterangan_ac' => $item->nama_item,
                    'tanggal_awal' => $detail['tanggal_awal'] ?? now(),
                    'tanggal_akhir' => $detail['tanggal_akhir'] ?? now(),
                    'metode_pembayaran' => $detail['metode_pembayaran'] ?? 'belum dipilih',
                    'jarak_km' => $item->jarak_km,
                    'biaya_jarak' => $item->biaya_jarak,
                    'total_harga' => $item->total_harga,
                ]);
            }
        }

        $pesanan = Pesanan::query()->create([
            'id_login' => $idLogin,
            'kode_pesanan' => 'JSA-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(5)),
            'total_harga' => $keranjang->sum('total_harga'),
            'status' => 'menunggu_pembayaran',
        ]);

        Keranjang::query()
            ->where('id_login', $idLogin)
            ->delete();

        return redirect()->route('pembayaran.index', $pesanan->id_pesanan);
    }

    private function ambilHarga(string $jenis, int $id): array
    {
        if ($jenis === 'beli') {
            $harga = HargaBeliAc::query()->findOrFail($id);

            return [
                'nama_item' => $harga->nama_merkac,
                'harga' => $harga->harga,
            ];
        }

        if ($jenis === 'jual') {
            $harga = HargaJualAc::query()->findOrFail($id);

            return [
                'nama_item' => $harga->nama_merkac,
                'harga' => $harga->harga,
            ];
        }

        $harga = HargaServiceAc::query()->findOrFail($id);

        return [
            'nama_item' => $harga->keterangan_ac,
            'harga' => $harga->harga,
        ];
    }
}
