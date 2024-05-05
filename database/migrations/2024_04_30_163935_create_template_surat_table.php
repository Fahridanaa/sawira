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
        Schema::create('template_surat', function (Blueprint $table) {
            $table->id('id_surat');
            $table->string('kode_surat', 8)->unique();
            $table->string('nama_surat', 50);
            $table->string('deskripsi_surat', 255);
            $table->string('var_surat', 255);
            $table->dateTime('tgl_pembuatan');
            $table->boolean('isActive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_surat');
    }
};
