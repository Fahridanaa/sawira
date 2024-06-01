<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class HouseConditionHelper
{
	public static function getHouseCondition($condition)
	{
		switch ($condition) {
			case 1:
				return 'Sangat Layak (kondisi baik)';
			case 2:
				return 'Layak (perlu sedikit perbaikan)';
			case 3:
				return 'Cukup Layak (rusak ringan)';
			case 4:
				return 'Tidak Layak (rusak sedang)';
			case 5:
				return 'Sangat Tidak Layak (rusak berat)';
			default:
				return 'Tidak Diketahui';
		}
	}
}