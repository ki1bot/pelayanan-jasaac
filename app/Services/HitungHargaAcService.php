<?php

namespace App\Services;

class HitungHargaService
{
    public function biayaJarak(float $jarakKm): float
    {
        return max($jarakKm, 0) * 5000;
    }

    public function total(float $hargaSatuan, int $jumlah, float $jarakKm): array
    {
        $jumlahFinal = max($jumlah, 1);
        $biayaJarak = $this->biayaJarak($jarakKm);
        $subtotal = $hargaSatuan * $jumlahFinal;

        return [
            'harga_satuan' => $hargaSatuan,
            'jumlah' => $jumlahFinal,
            'jarak_km' => $jarakKm,
            'biaya_jarak' => $biayaJarak,
            'total_harga' => $subtotal + $biayaJarak,
        ];
    }

    public function hitung(float $hargaSatuan, int $jumlah, float $jarakKm): array
    {
        $jumlahFinal = max($jumlah, 1);
        $jarakFinal = max($jarakKm, 0);
        $biayaJarak = $jarakFinal * 5000;
        $subtotal = $hargaSatuan * $jumlahFinal;

        return [
            'harga_satuan' => $hargaSatuan,
            'jumlah' => $jumlahFinal,
            'jarak_km' => $jarakFinal,
            'biaya_jarak' => $biayaJarak,
            'total_harga' => $subtotal + $biayaJarak,
        ];
    }
}
