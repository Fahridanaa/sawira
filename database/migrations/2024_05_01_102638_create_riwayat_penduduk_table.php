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
        Schema::create('riwayat_penduduk', function (Blueprint $table) {
            $table->id('id_riwayatPenduduk');
            $table->unsignedBigInteger('id_suratPindah')->index();
            $table->date('tanggal_keluar');
            $table->string('alamat_tujuan', 255);
            $table->string('alasan_keluar', 255);
            $table->timestamps();

            $table->foreign('id_suratPindah')->references('id_suratPindah')->on('surat_pindah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_penduduk');
    }
};
