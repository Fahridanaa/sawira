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
        Schema::create('akun', function (Blueprint $table) {
            $table->id('id_akun');
            $table->unsignedBigInteger('id_kk')->index();
            $table->unsignedBigInteger('id_level')->index();
            $table->string('username', 25)->unique();
            $table->string('password', 20);
            $table->timestamps();

            $table->foreign('id_kk')->references('id_kk')->on('kk');
            $table->foreign('id_level')->references('id_level')->on('level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun');
    }
};
