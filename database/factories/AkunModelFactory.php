<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AkunModel;
use App\Models\KKModel;
use App\Models\LevelModel;

class AkunModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = AkunModel::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'username' => $this->faker->userName(),
			'password' => $this->faker->password(),
			'id_kk' => KKModel::factory(),
			'id_level' => LevelModel::inRandomOrder()->first()->id_level
		];
	}
}
