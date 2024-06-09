<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RTModel extends Model
{
	use HasFactory;

	protected $table = 'rt';
	protected $primaryKey = 'id_rt';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'no_rt',
		'ketua_rt'
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_rt' => 'integer',
		'no_rt' => 'integer',
		'ketua_rt' => 'string'
	];

	public function kk()
	{
		return $this->hasMany(KKModel::class, 'id_rt', 'id_rt');
	}
}
