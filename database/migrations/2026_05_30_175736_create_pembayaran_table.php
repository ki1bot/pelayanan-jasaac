<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->increments('id_pembayaran');
            $table->unsignedInteger('id_pesanan');
            $table->enum('metode_pembayaran', ['qris', 'dana', 'shopeepay', 'gopay', 'bca']);
            $table->enum('status_pembayaran', ['menunggu', 'berhasil', 'gagal'])->default('menunggu');
            $table->string('bukti_pembayaran', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
