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
		Schema::create('kondisi_keluarga', function (Blueprint $table) {
			$table->id('id_kondisi_keluarga');
			$table->unsignedBigInteger('id_kk')->index();
			$table->integer('jumlah_penghasilan')->nullable();
			$table->integer('jumlah_pengeluaran')->nullable();
			$table->integer('jumlah_tanggungan')->nullable();
			$table->integer('jumlah_hutang')->nullable();
			$table->enum('kondisi_tempat_tinggal', [1, 2, 3, 4, 5])->nullable();
			$table->timestamps();

			$table->foreign('id_kk')->references('id_kk')->on('kk')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('kondisi_keluarga');
	}
};
