<?php

namespace Database\Seeders;

use App\Models\RTModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RTSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		for ($i = 1; $i <= 18; $i++) {
			RTModel::create([
				'no_rt' => $i
			]);
		}
	}
}
