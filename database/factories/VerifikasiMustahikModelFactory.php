<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\MustahikModel;
use App\Models\PengajuanMustahikModel;
use App\Models\VerifikasiMustahikModel;

class VerifikasiMustahikModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = VerifikasiMustahikModel::class;

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		return [
			'id_mustahik' => MustahikModel::factory(),
			'id_pengajuan' => PengajuanMustahikModel::factory(),
		];
	}
}
