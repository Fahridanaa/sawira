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
        Schema::create('verifikasi_mustahik', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mustahik')->index();
            $table->unsignedBigInteger('id_pengajuan')->index();
            $table->timestamps();

            $table->foreign('id_mustahik')->references('id_mustahik')->on('mustahik');
            $table->foreign('id_pengajuan')->references('id_pengajuan')->on('pengajuan_mustahik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi_mustahik');
    }
};
