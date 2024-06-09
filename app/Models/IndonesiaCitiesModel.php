<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravolt\Indonesia\Models\City;

class IndonesiaCitiesModel extends City
{
	use HasFactory;

	protected $table = 'indonesia_cities';
	protected $primaryKey = 'id';

	public function kk(): hasOne
	{
		return $this->hasOne(KKModel::class, 'id_kabupaten', 'id');
	}
}