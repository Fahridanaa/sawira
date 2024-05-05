<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\SuratPindahModel;

class SuratPindahModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = SuratPindahModel::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'surat_pindah' => $this->faker->regexify('[A-Za-z0-9]{255}'),
		];
	}
}
