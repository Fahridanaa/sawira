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
			'asal_kota' => $this->faker->city(),
			'tanggal_lahir' => $this->faker->date(),
			'agama' => $this->faker->randomElement(["Islam", "Kristen Protestan", "Katolik", "Hindu", "Buddha", "Khonghucu"]),
			'pendidikan_terakhir' => $this->faker->randomElement(["TK", "SD", "SMP", "SMA", "S1", "S2", "S3"]),
			'jenis_pekerjaan' => $this->faker->jobTitle(),
			'alamat' => $this->faker->address(),
			'tanggal_masuk' => $this->faker->date(),
			'isActive' => $this->faker->boolean(),
			'id_rt' => RTModel::inRandomOrder()->first()->id_rt,
			'id_kk' => KKModel::factory(),
			'id_hubungan' => StatusHubunganWargaModel::inRandomOrder()->first()->id_hubungan,
		];
	}
}
