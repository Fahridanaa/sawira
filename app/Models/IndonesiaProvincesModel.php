<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravolt\Indonesia\Models\Province;

class IndonesiaProvincesModel extends Province
{
	use HasFactory;

	protected $table = 'indonesia_provinces';
	protected $primaryKey = 'id';

	public function kk(): hasOne
	{
		return $this->hasOne(KKModel::class, 'id_provinsi', 'id');
	}
}