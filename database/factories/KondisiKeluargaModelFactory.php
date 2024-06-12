<?php

namespace Database\Factories;

use App\Models\KKModel;
use App\Models\KondisiKeluargaModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class KondisiKeluargaModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = KondisiKeluargaModel::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'id_kk' => KKModel::factory(),
			'kondisi_tempat_tinggal' => $this->faker->numberBetween(1, 5),
			'jumlah_penghasilan' => $this->faker->numberBetween(1000000, 10000000),
			'jumlah_pengeluaran' => $this->faker->numberBetween(1000000, 10000000),
			'jumlah_hutang' => $this->faker->numberBetween(1000000, 10000000),
			'jumlah_tanggungan' => $this->faker->numberBetween(1, 10),
		];
	}
}