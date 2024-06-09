<?php

namespace App\Models;

use Laravolt\Indonesia\Models\District;

class IndonesiaDistrictsModel extends District
{
	protected $table = 'indonesia_districts';
	protected $primaryKey = 'id';

	public function kk()
	{
		return $this->hasOne(KKModel::class, 'id_kecamatan', 'id');
	}
}