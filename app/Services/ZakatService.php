<?php

namespace App\Services;

use App\Models\KondisiKeluargaModel;

class ZakatService
{
	public function getAlternative()
	{
		$kkData = KondisiKeluargaModel::with(['kk' => function ($query) {
			$query->select('id_kk', 'no_kk');
		}])->take(10)->get();

		$citizensData = KondisiKeluargaModel::with(['kk.citizens' => function ($query) {
			$query->select('id_kk', 'nama_lengkap')
				->where('id_hubungan', 1);
		}])->take(10)->get();

		return $kkData->merge($citizensData)->toArray();
	}
}