<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PengajuanMustahikModel;

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
	 */
	public function definition(): array
	{
		return [
			'verifikasi_amil' => $verifikasiAmil = $this->faker->boolean,
			'alasan_ditolak' => $verifikasiAmil ? null : $this->faker->text(),
		];
	}
}
