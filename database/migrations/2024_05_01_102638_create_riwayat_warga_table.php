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
		Schema::create('riwayat_warga', function (Blueprint $table) {
			$table->id('id_riwayatWarga');
			$table->unsignedBigInteger('id_warga')->index();
			$table->date('tanggal');
			$table->enum('status', ['Pindah', 'Kematian']);
			$table->string('file_surat', 255)->nullable();
			$table->softDeletes(); // Tambahkan kolom deleted_at
			$table->timestamps();

			$table->foreign('id_warga')->references('id_warga')->on('warga');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('riwayat_warga');
		Schema::table('riwayat_warga', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Hapus kolom deleted_at
        });
	}
};
