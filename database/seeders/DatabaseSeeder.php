<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\KKModel;
use App\Models\CitizensModel;
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
		KKModel::factory(25)->create();
		$this->call(TemplateSuratSeeder::class);
		CitizensModel::factory(250)->create();
	}
}
