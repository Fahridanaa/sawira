<?php

namespace Database\Factories;

use App\Models\UsersModel;
use App\Models\RTModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\KKModel;
use Laravolt\Indonesia\Models\Kabupaten;
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Kelurahan;
use Laravolt\Indonesia\Models\Province;

class KKModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = KKModel::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'no_kk' => $this->faker->numerify('###############'),
			'id_user' => UsersModel::factory(),
			'id_provinsi' => $this->faker->numberBetween(1, 2),
			'id_kabupaten' => $this->faker->numberBetween(1, 2),
			'id_kecamatan' => $this->faker->numberBetween(1, 2),
			'id_kelurahan' => $this->faker->numberBetween(1, 2),
			'id_rt' => RTModel::inRandomOrder()->first()->id_rt,
			'alamat' => $this->faker->address(),
			'kode_pos' => $this->faker->numerify('#####'),
		];
	}
}
