<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\KKModel;
use App\Models\CitizensModel;
use App\Models\KondisiKeluargaModel;
use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Seeds\CitiesSeeder;
use Laravolt\Indonesia\Seeds\DistrictsSeeder;
use Laravolt\Indonesia\Seeds\ProvincesSeeder;
use Laravolt\Indonesia\Seeds\VillagesSeeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$this->call([
			ProvincesSeeder::class,
			CitiesSeeder::class,
			DistrictsSeeder::class,
			VillagesSeeder::class,
		]);
		$this->call(UserSeeder::class);
		$this->call(RTSeeder::class);
		$this->call(StatusHubunganWargaSeeder::class);
		$this->call(TemplateSuratSeeder::class);
		$families = KKModel::factory()
			->count(15)
			->create();
		$families->each(function ($family) {
			CitizensModel::factory()
				->count(4)
				->create(['id_kk' => $family->id_kk]);
		});
	}
}
