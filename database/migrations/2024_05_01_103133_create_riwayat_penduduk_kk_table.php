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
        Schema::create('riwayat_penduduk_kk', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kk')->index();
            $table->unsignedBigInteger('id_riwayatPenduduk')->index();
            $table->timestamps();

            $table->foreign('id_kk')->references('id_kk')->on('kk');
            $table->foreign('id_riwayatPenduduk')->references('id_riwayatPenduduk')->on('riwayat_penduduk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_penduduk_kk');
    }
};
