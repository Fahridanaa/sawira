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
		Schema::create('arsip_surat', function (Blueprint $table) {
			$table->id('id_arsip_surat');
			$table->unsignedBigInteger('id_user')->index();
			$table->unsignedBigInteger('id_template_surat')->index();
			$table->date('tanggal_pengajuan');
			$table->string('data_surat', 255);
			$table->timestamps();

			$table->foreign('id_user')->references('id_user')->on('users');
			$table->foreign('id_template_surat')->references('id_template_surat')->on('template_surat');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('riwayat_surat');
	}
};
