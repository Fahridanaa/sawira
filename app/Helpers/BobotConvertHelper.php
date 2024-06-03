<?php

namespace App\Helpers;

class BobotConvertHelper
{
	public static function CriteriaConvert($dataAlternative): array
	{
		$convert = [];
		foreach ($dataAlternative as $key => $value) {
			$convert[$key]['no_kk'] = $value['kk']['no_kk'];
			$convert[$key]['nama_lengkap'] = $value['kk']['citizens'][0]['nama_lengkap'];
			$convert[$key]['id_kondisi_keluarga'] = $value['id_kondisi_keluarga'];


			if ($value["jumlah_penghasilan"] > 4000000) {
				$convert[$key][0] = 1;
			} elseif ($value["jumlah_penghasilan"] > 300000) {
				$convert[$key][0] = 2;
			} elseif ($value["jumlah_penghasilan"] > 200000) {
				$convert[$key][0] = 3;
			} elseif ($value["jumlah_penghasilan"] > 100000) {
				$convert[$key][0] = 4;
			} else {
				$convert[$key][0] = 5;
			}

			if ($value["jumlah_pengeluaran"] > 3000000) {
				$convert[$key][1] = 5;
			} elseif ($value["jumlah_pengeluaran"] > 2500000) {
				$convert[$key][1] = 4;
			} elseif ($value["jumlah_pengeluaran"] > 2000000) {
				$convert[$key][1] = 3;
			} elseif ($value["jumlah_pengeluaran"] > 1500000) {
				$convert[$key][1] = 2;
			} else {
				$convert[$key][1] = 1;
			}

			if ($value["jumlah_tanggungan"] > 5) {
				$convert[$key][2] = 5;
			} elseif ($value["jumlah_tanggungan"] >= 4) {
				$convert[$key][2] = 4;
			} elseif ($value["jumlah_tanggungan"] >= 3) {
				$convert[$key][2] = 3;
			} elseif ($value["jumlah_tanggungan"] >= 2) {
				$convert[$key][2] = 2;
			} else {
				$convert[$key][2] = 1;
			}

			if ($value["jumlah_hutang"] > 2000000) {
				$convert[$key][3] = 5;
			} elseif ($value["jumlah_hutang"] > 1500000) {
				$convert[$key][3] = 4;
			} elseif ($value["jumlah_hutang"] > 1000000) {
				$convert[$key][3] = 3;
			} elseif ($value["jumlah_hutang"] > 500000) {
				$convert[$key][3] = 2;
			} else {
				$convert[$key][3] = 1;
			}

			if ($value["kondisi_tempat_tinggal"] == 1) {
				$convert[$key][4] = 1;
			} elseif ($value["kondisi_tempat_tinggal"] == 2) {
				$convert[$key][4] = 2;
			} elseif ($value["kondisi_tempat_tinggal"] == 3) {
				$convert[$key][4] = 3;
			} elseif ($value["kondisi_tempat_tinggal"] == 4) {
				$convert[$key][4] = 4;
			} else {
				$convert[$key][4] = 5;
			}
		}
		return $convert;
	}
}