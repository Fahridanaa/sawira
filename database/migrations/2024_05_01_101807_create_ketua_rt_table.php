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
        Schema::create('ketua_rt', function (Blueprint $table) {
            $table->unsignedBigInteger('id_rt')->index();
            $table->unsignedBigInteger('id_warga')->index();
            $table->timestamps();

            $table->foreign('id_rt')->references('id_rt')->on('rt');
            $table->foreign('id_warga')->references('id_warga')->on('semua_warga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ketua_rt');
    }
};
