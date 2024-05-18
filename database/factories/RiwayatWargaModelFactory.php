<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\RiwayatWargaModel;
use App\Models\CitizensModel;

class RiwayatWargaModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = RiwayatWargaModel::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'kategori_riwayat' => $this->faker->randomElement(['kematian', 'pindah kk']),
			'id_warga' => CitizensModel::factory(),
		];
	}
}
