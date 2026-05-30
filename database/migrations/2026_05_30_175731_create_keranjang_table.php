<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->increments('id_keranjang');
            $table->unsignedInteger('id_login');
            $table->enum('jenis_pesanan', ['beli', 'jual', 'service']);
            $table->unsignedInteger('id_harga');
            $table->string('nama_item', 191);
            $table->string('nama_pemesan', 100);
            $table->string('jenis_kelamin', 20);
            $table->string('telepon', 20)->nullable();
            $table->string('lokasi', 150);
            $table->integer('jumlah')->default(1);
            $table->decimal('harga_satuan', 12, 2);
            $table->decimal('jarak_km', 8, 2);
            $table->decimal('biaya_jarak', 12, 2);
            $table->decimal('total_harga', 12, 2);
            $table->json('detail')->nullable();
            $table->timestamps();

            $table->foreign('id_login')->references('id_login')->on('loginac')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
