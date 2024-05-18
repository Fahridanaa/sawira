<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\KKModel;
use App\Models\RiwayatPendudukModel;
use App\Models\RiwayatPindahModel;
use App\Models\SuratPindahModel;

class RiwayatPindahModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = RiwayatPindahModel::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'id_kk' => KKModel::factory(),
			'id_suratPindah' => SuratPindahModel::factory(),
			'tgl_keluar' => $this->faker->date(),
			'alamat_tujuan' => $this->faker->address(),
			'alasan_keluar' => $this->faker->text()
		];
	}
}
