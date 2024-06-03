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
		Schema::create('smart_rank', function (Blueprint $table) {
			$table->id('id_smart_rank');
			$table->unsignedBigInteger('id_kondisi_keluarga')->index();
			$table->decimal('nilai_smart', 50, 10);
			$table->timestamps();

			$table->foreign('id_kondisi_keluarga')->references('id_kondisi_keluarga')->on('kondisi_keluarga')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('smart_rank');
	}
};
