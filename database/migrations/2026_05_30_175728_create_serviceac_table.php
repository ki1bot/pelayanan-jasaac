<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('serviceac', function (Blueprint $table) {
            $table->increments('id_service');
            $table->unsignedInteger('id_hargaservice');
            $table->string('nama_client', 100);
            $table->string('jenis_kelamin', 20);
            $table->string('telp_client', 20);
            $table->string('lokasi_client', 150);
            $table->string('keterangan_ac', 191);
            $table->dateTime('tanggal_awal');
            $table->dateTime('tanggal_akhir');
            $table->string('metode_pembayaran', 100);
            $table->decimal('jarak_km', 8, 2)->default(0);
            $table->decimal('biaya_jarak', 12, 2)->default(0);
            $table->decimal('total_harga', 12, 2);
            $table->timestamps();

            $table->foreign('id_hargaservice')->references('id_hargaservice')->on('hargaserviceac')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('serviceac');
    }
};
