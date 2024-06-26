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
		Schema::create('warga', function (Blueprint $table) {
			$table->id('id_warga');
			$table->unsignedBigInteger('id_kk')->index();
			$table->unsignedBigInteger('id_hubungan')->index();
			$table->string('nik', 16)->unique();
			$table->string('nama_lengkap', 100);
			$table->string('no_telp', 30);
			$table->enum('jenis_kelamin', ['L', 'P']);
			$table->string('asal_tempat', 50);
			$table->date('tanggal_lahir');
			$table->enum('agama', ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
			$table->enum('status_perkawinan', ['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati']);
			$table->enum('kewarganegaraan', ['WNI', 'WNA']);
			$table->string('pendidikan_terakhir', 20);
			$table->string('pekerjaan', 255);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('id_kk')->references('id_kk')->on('kk');
			$table->foreign('id_hubungan')->references('id_hubungan')->on('status_hubungan_warga');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('warga');
	}
};
