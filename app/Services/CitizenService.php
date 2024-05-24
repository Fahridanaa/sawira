<?php

namespace App\Services;

use App\Models\CitizensModel;
use App\Models\KKModel;
use Illuminate\Support\Facades\DB;

class CitizenService
{
	public function createCitizens(array $citizensData, int $id_kk)
	{
		foreach ($citizensData as $citizen) {
			CitizensModel::create(array_merge($citizen, [
				'id_kk' => $id_kk,
			]));
		}
	}
}