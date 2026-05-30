<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->increments('id_pesanan');
            $table->unsignedInteger('id_login');
            $table->string('kode_pesanan', 50)->unique();
            $table->decimal('total_harga', 12, 2);
            $table->enum('status', ['menunggu_pembayaran', 'diproses', 'selesai', 'dibatalkan'])->default('menunggu_pembayaran');
            $table->timestamps();

            $table->foreign('id_login')->references('id_login')->on('loginac')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
