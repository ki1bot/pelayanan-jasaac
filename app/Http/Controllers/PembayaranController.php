<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index(int $id)
    {
        $pesanan = Pesanan::query()->findOrFail($id);

        $this->pastikanPemilikPesanan($pesanan);

        $pembayaran = Pembayaran::query()
            ->where('id_pesanan', $pesanan->id_pesanan)
            ->first(['*']);

        return view('pembayaran.pembayaran', compact('pesanan', 'pembayaran'));
    }

    public function store(Request $request, int $id)
    {
        $pesanan = Pesanan::query()->findOrFail($id);

        $this->pastikanPemilikPesanan($pesanan);

        $data = $request->validate([
            'metode_pembayaran' => ['required', 'in:qris,dana,shopeepay,gopay,bca'],
            'bukti_pembayaran' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:2048'],
        ]);

        $path = null;

        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('bukti-pembayaran', 'public');
        }

        Pembayaran::query()->updateOrCreate(
            [
                'id_pesanan' => $pesanan->id_pesanan,
            ],
            [
                'metode_pembayaran' => $data['metode_pembayaran'],
                'status_pembayaran' => 'menunggu',
                'bukti_pembayaran' => $path,
            ]
        );

        return redirect()->route('beranda')->with('success', 'Pembayaran berhasil dikirim dan menunggu verifikasi.');
    }

    private function pastikanPemilikPesanan(Pesanan $pesanan): void
    {
        $user = Auth::user();

        if (! $user) {
            abort(403);
        }

        if ($user->getAttribute('role') === 'pemilik') {
            return;
        }

        if ((int) $pesanan->id_login !== (int) Auth::id()) {
            abort(403);
        }
    }
}
