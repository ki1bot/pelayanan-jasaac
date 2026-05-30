<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loginac', function (Blueprint $table) {
            $table->increments('id_login');
            $table->string('nama', 100);
            $table->string('jenis_kelamin', 20);
            $table->string('username', 100)->unique();
            $table->string('email', 150)->nullable()->unique();
            $table->string('password');
            $table->string('google_id', 150)->nullable()->unique();
            $table->string('facebook_id', 150)->nullable()->unique();
            $table->enum('role', ['pemilik', 'pengguna'])->default('pengguna');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loginac');
    }
};
