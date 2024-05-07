<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\RiwayatPendudukModel;
use App\Models\SuratPindahModel;

class RiwayatPendudukModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = RiwayatPendudukModel::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'tanggal_keluar' => $this->faker->date(),
			'alamat_tujuan' => $this->faker->address(),
			'alasan_keluar' => $this->faker->address(),
			'id_suratPindah' => SuratPindahModel::factory(),
		];
	}
}
