<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UsersModel;
use App\Models\KetuaRTModel;
use App\Models\KKModel;
use App\Models\MustahikModel;
use App\Models\NotifikasiModel;
use App\Models\PengajuanMustahikModel;
use App\Models\RiwayatPindahModel;
use App\Models\RiwayatWargaModel;
use App\Models\RiwayatSuratModel;
use App\Models\RTModel;
use App\Models\CitizensModel;
use App\Models\StatusHubunganWargaModel;
use App\Models\SuratPindahModel;
use App\Models\TemplateSuratModel;
use App\Models\VerifikasiMustahikModel;
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
		SuratPindahModel::factory(3)->create();
		TemplateSuratModel::factory(3)->create();
		$this->call(KategoriMustahikSeeder::class);
		PengajuanMustahikModel::factory(5)->create();
		CitizensModel::factory(25)->create();
		KetuaRTModel::factory(18)->create();
		RiwayatWargaModel::factory(15)->create();
		RiwayatPindahModel::factory(10)->create();
		NotifikasiModel::factory(25)->create();
		RiwayatSuratModel::factory(5)->create();
		MustahikModel::factory(25)->create();
		VerifikasiMustahikModel::factory(15)->create();
		KKModel::factory(25)->create();
	}
}
