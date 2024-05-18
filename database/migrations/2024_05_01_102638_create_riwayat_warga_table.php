<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_warga', function (Blueprint $table) {
            $table->id('id_riwayatWarga');
            $table->unsignedBigInteger('id_warga')->index();
            $table->string('kategori_riwayat', 255);
            $table->timestamps();

            $table->foreign('id_warga')->references('id_warga')->on('semua_warga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_warga');
    }
};