<?php

namespace Database\Factories;

use App\Models\CitizensModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\KKModel;
use App\Models\RTModel;
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
			'nik' => $this->faker->numerify('###############'),
			'nama_lengkap' => $this->faker->name(),
			'no_telp' => $this->faker->phoneNumber(),
			'jenis_kelamin' => $this->faker->randomElement(["L", "P"]),
			'asal_tempat' => $this->faker->city(),
			'tanggal_lahir' => $this->faker->date(),
			'agama' => $this->faker->randomElement(["Islam", "Kristen Protestan", "Katolik", "Hindu", "Buddha", "Konghucu"]),
			'pendidikan_terakhir' => $this->faker->randomElement(["TK", "SD", "SMP", "SMA", "D1", "D2", "D3", "S1/D4", "S2", "S3"]),
			'pekerjaan' => $this->faker->jobTitle(),
			'id_kk' => KKModel::inRandomOrder()->first()->id_kk,
			'id_hubungan' => StatusHubunganWargaModel::inRandomOrder()->first()->id_hubungan,
		];
	}
}
