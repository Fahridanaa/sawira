<?php

namespace Database\Factories;

use App\Models\KategoriMustahikModel;
use App\Models\PengajuanMustahikModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengajuanMustahikModel>
 */
class PengajuanMustahikModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = PengajuanMustahikModel::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'kondisi_rumah' => $this->faker->randomElement(["1", "2", "3", "4", "5"]),
			'pendapatan_bulanan' => $this->faker->numberBetween(0, 1000000),
			'pengeluaran_bulanan' => $this->faker->numberBetween(0, 1000000),
			'jumlah_hutang' => $this->faker->numberBetween(0, 1000000),
			'id_kategori' => KategoriMustahikModel::inRandomOrder()->first()->id_kategori,
			'id_warga' => $this->faker->unique()->numberBetween(1, 250),
		];
	}
}
