<?php

namespace Database\Factories;

use App\Models\CitizensModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\KKModel;
use App\Models\StatusHubunganWargaModel;

class CitizensModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = CitizensModel::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'nik' => $this->faker->numerify('################'),
			'nama_lengkap' => $this->faker->name(),
			'no_telp' => $this->generateIndonesianPhoneNumber(),
			'jenis_kelamin' => $this->faker->randomElement(["L", "P"]),
			'asal_tempat' => $this->faker->city(),
			'tanggal_lahir' => $this->faker->date(),
			'agama' => $this->faker->randomElement(["Islam", "Kristen Protestan", "Katolik", "Hindu", "Buddha", "Konghucu"]),
			'status_perkawinan' => $this->faker->randomElement(["Kawin", "Belum Kawin", "Cerai Hidup", "Cerai Mati"]),
			'kewarganegaraan' => $this->faker->randomElement(["WNI", "WNA"]),
			'pendidikan_terakhir' => $this->faker->randomElement(["TK", "SD", "SMP", "SMA", "D1", "D2", "D3", "S1/D4", "S2", "S3"]),
			'pekerjaan' => $this->faker->jobTitle(),
			'id_kk' => KKModel::factory(),
			'id_hubungan' => $this->faker->numberBetween(2, StatusHubunganWargaModel::count()),
		];
	}

	/**
	 * Generate a random Indonesian phone number.
	 *
	 * @return string
	 */
	private function generateIndonesianPhoneNumber(): string
	{
		$areaCode = $this->faker->numerify('08##');
		$subscriberNumber = $this->faker->numerify('########');

		return $areaCode . $subscriberNumber;
	}

	/**
	 * Configure the factory.
	 *
	 * @return $this
	 */
	public function configure()
	{
		return $this->afterMaking(function (CitizensModel $citizen) {
		})->afterCreating(function (CitizensModel $citizen) {
			static $kkHubungan = [];

			$id_kk = $citizen->id_kk;

			if (!isset($kkHubungan[$id_kk])) {
				$kkHubungan[$id_kk] = false;
			}

			if (!$kkHubungan[$id_kk]) {
				$citizen->id_hubungan = 1;
				$citizen->save();
				$kkHubungan[$id_kk] = true;
			}
		});
	}
}
