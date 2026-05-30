<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hargaserviceac', function (Blueprint $table) {
            $table->increments('id_hargaservice');
            $table->string('keterangan_ac', 191)->unique();
            $table->integer('harga');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hargaserviceac');
    }
};
