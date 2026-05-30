<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pusatservice', function (Blueprint $table) {
            $table->increments('id_pusat');
            $table->string('lokasi_pusat', 150)->unique();
            $table->timestamps();
        });

        DB::table('pusatservice')->insert([
            'lokasi_pusat' => 'Jakarta',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('pusatservice');
    }
};
