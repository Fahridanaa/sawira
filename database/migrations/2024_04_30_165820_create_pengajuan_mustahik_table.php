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
		Schema::create('pengajuan_mustahik', function (Blueprint $table) {
			$table->id('id_pengajuan');
			$table->boolean('verifikasi_amil');
			$table->string('alasan_ditolak', 255)->nullable();
			$table->timestamps();
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
