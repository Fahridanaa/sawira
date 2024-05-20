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

	private static $kkIds = [];

	/**
	 * Define the model's default state.
	 */
	public function definition(): array
	{
		if (empty(self::$kkIds)) {
			self::$kkIds = KKModel::all()->pluck('id_kk')->toArray(); // get all citizen Ids
		}

		$randomIdKKKey = array_rand(self::$kkIds); // Pick a random key
		$randomWargaId = self::$kkIds[$randomIdKKKey]; // Get the corresponding value
		unset(self::$kkIds[$randomIdKKKey]); // Remove used id from the pool


		return [
			'id_kk' => $randomWargaId,
			'id_suratPindah' => SuratPindahModel::factory(),
			'tanggal' => $this->faker->date(),
			'alamat_tujuan' => $this->faker->address(),
			'alasan_keluar' => $this->faker->text()
		];
	}
}
