<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\TemplateSuratModel;

class TemplateSuratModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = TemplateSuratModel::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'kode_surat' => $this->faker->numerify('SRT-###'),
			'nama_surat' => $this->faker->colorName(),
			'deskripsi_surat' => $this->faker->text(),
			'var_surat' => $this->faker->regexify('[A-Za-z0-9]{255}'),
			'tgl_pembuatan' => $this->faker->dateTime(),
			'isActive' => $this->faker->boolean(),
		];
	}
}
