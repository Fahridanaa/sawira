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
        Schema::create('riwayat_surat', function (Blueprint $table) {
            $table->id('id_riwayatSurat');
            $table->unsignedBigInteger('id_surat')->index();            
            $table->string('data_surat', 255);
            
            $table->foreign('id_surat')->references('id_surat')->on('template_surat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_surat');
    }
};
