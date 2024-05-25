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
		Schema::create('verifikasi_mustahik', function (Blueprint $table) {
			$table->id('id_verifikasi');
			$table->unsignedBigInteger('id_pengajuan_mustahik')->index();
			$table->boolean('verifikasi_amil');
			$table->string('alasan_ditolak', 255)->nullable();
			$table->timestamps();

			$table->foreign('id_pengajuan_mustahik')->references('id_pengajuan_mustahik')->on('pengajuan_mustahik');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('pengajuan_mustahik');
	}
};
