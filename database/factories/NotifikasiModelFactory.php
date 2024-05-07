<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AkunModel;
use App\Models\NotifikasiModel;

class NotifikasiModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = NotifikasiModel::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'jenis_notifikasi' => $this->faker->randomElement(["danger", "warning", "success"]),
			'tanggal_notifikasi' => $this->faker->date(),
			'id_akun' => AkunModel::factory(),
		];
	}
}
