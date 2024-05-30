<?php

namespace Database\Factories;

use App\Models\ArsipSuratModel;
use App\Models\UsersModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ArsipSuratModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = ArsipSuratModel::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'id_template_surat' => 1,
			'id_user' => UsersModel::inRandomOrder()->first()->id_user,
			'tanggal_pengajuan' => $this->faker->date(),
			'data_surat' => $this->faker->text(),
		];
	}
}
