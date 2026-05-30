<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beliac', function (Blueprint $table) {
            $table->increments('id_beli');
            $table->unsignedInteger('id_hargabeli');
            $table->string('nama_pembeli', 100);
            $table->string('jenis_kelamin', 20);
            $table->string('merk_ac', 100);
            $table->string('lokasi', 150);
            $table->integer('jumlah');
            $table->dateTime('tanggal');
            $table->string('metode_pembayaran', 100);
            $table->string('metode_pengiriman', 100);
            $table->decimal('jarak_km', 8, 2)->default(0);
            $table->decimal('biaya_jarak', 12, 2)->default(0);
            $table->decimal('total_harga', 12, 2);
            $table->timestamps();

            $table->foreign('id_hargabeli')->references('id_hargabeli')->on('hargabeliac')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beliac');
    }
};
