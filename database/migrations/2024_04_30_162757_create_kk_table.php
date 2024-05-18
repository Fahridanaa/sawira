<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('kk', function (Blueprint $table) {
			$table->id('id_kk');
			$table->unsignedBigInteger('id_akun')->index();
			$table->unsignedBigInteger('id_provinsi')->index();
			$table->unsignedBigInteger('id_kabupaten')->index();
			$table->unsignedBigInteger('id_kecamatan')->index();
			$table->unsignedBigInteger('id_kelurahan')->index();
			$table->unsignedBigInteger('id_rt')->index();
			$table->string('no_kk', 16)->unique();
			$table->string('alamat', 255)->nullable();
			$table->string('kode_pos', 5)->nullable();
			$table->timestamps();

			$table->foreign('id_akun')->references('id_akun')->on('akun');
			$table->foreign('id_provinsi')->references('id')->on('indonesia_provinces');
			$table->foreign('id_kabupaten')->references('id')->on('indonesia_cities');
			$table->foreign('id_kecamatan')->references('id')->on('indonesia_districts');
			$table->foreign('id_kelurahan')->references('id')->on('indonesia_villages');
			$table->foreign('id_rt')->references('id_rt')->on('rt');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('kk');
	}
};
