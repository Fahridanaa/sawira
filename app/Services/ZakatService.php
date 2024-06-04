<?php

namespace App\Services;

use App\Models\KondisiKeluargaModel;

class ZakatService
{
	public function getAlternative()
	{
		$kkData = KondisiKeluargaModel::with(['kk' => function ($query) {
			$query->select('id_kk', 'no_kk')->whereNotNull('id_kk')->whereNotNull('no_kk');
		}])->whereNotNull('jumlah_penghasilan')
			->whereNotNull('jumlah_pengeluaran')
			->whereNotNull('jumlah_tanggungan')
			->whereNotNull('jumlah_hutang')
			->whereNotNull('kondisi_tempat_tinggal')
			->take(10)->get();

		$citizensData = KondisiKeluargaModel::with(['kk.citizens' => function ($query) {
			$query->select('id_kk', 'nama_lengkap')->whereNotNull('id_kk')->whereNotNull('nama_lengkap')
				->where('id_hubungan', 1);
		}])->whereNotNull('jumlah_penghasilan')
			->whereNotNull('jumlah_pengeluaran')
			->whereNotNull('jumlah_tanggungan')
			->whereNotNull('jumlah_hutang')
			->whereNotNull('kondisi_tempat_tinggal')
			->take(10)->get();

		return $kkData->merge($citizensData)->toArray();
	}
}