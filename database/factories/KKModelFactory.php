<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\KKModel;

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
		];
	}
}
