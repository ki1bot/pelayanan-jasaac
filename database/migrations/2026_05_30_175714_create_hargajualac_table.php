<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hargajualac', function (Blueprint $table) {
            $table->increments('id_hargajual');
            $table->string('nama_merkac', 100)->unique();
            $table->integer('harga');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hargajualac');
    }
};
