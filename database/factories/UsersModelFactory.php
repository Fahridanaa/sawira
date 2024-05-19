<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\UsersModel;
use App\Models\KKModel;
use App\Models\LevelModel;

class UsersModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = UsersModel::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'username' => $this->faker->userName(),
			'password' => $this->faker->password(),
			'id_level' => 4,
		];
	}
}
