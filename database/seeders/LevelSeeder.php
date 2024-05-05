<?php

namespace Database\Seeders;

use App\Models\LevelModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$levelList = ['warga', 'rt', 'rw', 'amil'];
		foreach ($levelList as $index => $level) {
			LevelModel::create([
				'kode_level' => 'LVL' . ($index + 1),
				'nama_level' => $level
			]);
		}
	}
}
