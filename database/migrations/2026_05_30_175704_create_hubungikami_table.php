<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hubungikami', function (Blueprint $table) {
            $table->increments('id_hubungi');
            $table->string('nama', 100);
            $table->string('email', 100);
            $table->string('subjek', 150);
            $table->text('pesan');
            $table->dateTime('tanggal')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hubungikami');
    }
};
