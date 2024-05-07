<?php

namespace Database\Factories;

use App\Models\PengajuanMustahikModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\KategoriMustahikModel;
use App\Models\MustahikModel;

class MustahikModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = MustahikModel::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'kondisi_rumah' => $this->faker->randomElement(["1", "2", "3", "4", "5"]),
			'pendapatan_bulanan' => $this->faker->numberBetween(0, 1000000),
			'pengeluaran_bulanan' => $this->faker->numberBetween(0, 1000000),
			'jumlah_hutang' => $this->faker->numberBetween(0, 1000000),
			'id_pengajuan' => PengajuanMustahikModel::inRandomOrder()->first()->id_pengajuan,
			'id_kategori' => KategoriMustahikModel::inRandomOrder()->first()->id_kategori,
		];
	}
}
