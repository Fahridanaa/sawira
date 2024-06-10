<?php

namespace App\Services;

use App\Models\KKModel;

class FamilyService
{
	public function getKKRecords(int $rt)
	{
		$kkRecords = KKModel::with(['citizens' => function ($query) {
			$query->where('id_hubungan', 1);
		}])->where('id_rt', $rt)->get();

		$headFamilyRecords = $kkRecords->mapWithKeys(function ($kkRecord) {
			if (isset($kkRecord->citizens->first()->nama_lengkap)) return [$kkRecord['id_kk'] => $kkRecord->citizens->first()->nama_lengkap];
			return [];
		});

		return ['kkRecords' => $kkRecords, 'headFamilyRecords' => $headFamilyRecords];
	}
}