<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\KetuaRTModel;
use App\Models\RTModel;
use App\Models\CitizensModel;

class KetuaRTModelFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = KetuaRTModel::class;

	private static $rtIds = [];
	private static $wargaIds = [];

	/**
	 * Define the model's default state.
	 */
	public function definition()
	{
		if (empty(self::$rtIds)) {
			self::$rtIds = range(1, 18); // Generate an array of unique ids from 1 to 18 for id_rt
		}

		if (empty(self::$wargaIds)) {
			self::$wargaIds = CitizensModel::all()->pluck('id_warga')->toArray(); // get all citizen Ids
		}

		$sequentialRtId = array_shift(self::$rtIds);

		$randomIdWargaKey = array_rand(self::$wargaIds); // Pick a random key
		$randomWargaId = self::$wargaIds[$randomIdWargaKey]; // Get the corresponding value
		unset(self::$wargaIds[$randomIdWargaKey]); // Remove used id from the pool

		return [
			'id_rt' => $sequentialRtId,
			'id_warga' => $randomWargaId,
		];
	}
}
