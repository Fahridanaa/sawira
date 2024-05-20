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
		Schema::create('users', function (Blueprint $table) {
			$table->id('id_user');
			$table->string('username', 25);
			$table->enum('role', ['rw', 'rt1', 'rt2', 'rt3', 'rt4', 'rt5', 'rt6', 'rt7', 'rt8', 'rt9', 'rt10', 'rt11', 'rt12', 'rt13', 'rt14', 'rt15', 'rt16', 'rt17', 'rt18', 'amil', 'warga'])->default('warga');
			$table->string('password', 255);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('users');
	}
};
