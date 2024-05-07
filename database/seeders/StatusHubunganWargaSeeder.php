<?php

namespace Database\Seeders;

use App\Models\StatusHubunganWargaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusHubunganWargaSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$hubunganList = ['Kepala Keluarga', 'Istri', 'Anak'];
		foreach ($hubunganList as $hubungan) {
			StatusHubunganWargaModel::create(['nama_hubungan' => $hubungan]);
		}
	}
}
