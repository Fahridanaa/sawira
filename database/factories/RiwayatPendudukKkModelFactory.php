<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\KKModel;
use App\Models\RiwayatPendudukModel;
use App\Models\RiwayatPendudukKkModel;

class RiwayatPendudukKkModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = RiwayatPendudukKkModel::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'id_kk' => KKModel::factory(),
			'id_riwayatPenduduk' => RiwayatPendudukModel::factory(),
		];
	}
}
