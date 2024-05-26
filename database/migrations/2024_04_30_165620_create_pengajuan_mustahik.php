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
			$table->id('id_pengajuan_mustahik');
			$table->unsignedBigInteger('id_warga')->index();
			$table->unsignedBigInteger('id_kategori')->index();
			$table->enum('kondisi_rumah', [1, 2, 3, 4, 5]);
			$table->integer('pendapatan_bulanan');
			$table->integer('pengeluaran_bulanan');
			$table->integer('jumlah_hutang');
			$table->timestamps();

			$table->foreign('id_warga')->references('id_warga')->on('warga');
			$table->foreign('id_kategori')->references('id_kategori')->on('kategori_mustahik');
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
