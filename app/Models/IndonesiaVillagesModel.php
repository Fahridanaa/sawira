<?php

namespace App\Models;

use Laravolt\Indonesia\Models\Village;

class IndonesiaVillagesModel extends Village
{
	protected $table = 'indonesia_villages';
	protected $primaryKey = 'id';

	public function kk()
	{
		return $this->hasOne(KKModel::class, 'id_kelurahan', 'id');
	}
}