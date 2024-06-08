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
		Schema::create('riwayat_kk', function (Blueprint $table) {
			$table->id('id_riwayatKK');
			$table->unsignedBigInteger('id_kk')->index();
			$table->date('tanggal');
			$table->enum('status', ['Pindah', 'Kematian']);
			$table->string('file_surat', 255)->nullable();
			$table->timestamps();

			$table->foreign('id_kk')->references('id_kk')->on('kk');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('riwayat_kk');
	}
};
