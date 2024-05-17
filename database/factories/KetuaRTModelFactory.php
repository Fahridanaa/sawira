<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\KetuaRTModel;
use App\Models\RTModel;
use App\Models\CitizensModel;

class KetuaRTModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = KetuaRTModel::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'id_rt' => RTModel::inRandomOrder()->first()->id_rt,
			'id_warga' => CitizensModel::factory(),
		];
	}
}
