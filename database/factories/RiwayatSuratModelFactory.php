<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\RiwayatSuratModel;
use App\Models\TemplateSuratModel;

class RiwayatSuratModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = RiwayatSuratModel::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'data_surat' => $this->faker->regexify('[A-Za-z0-9]{255}'),
			'id_surat' => TemplateSuratModel::factory(),
		];
	}
}
