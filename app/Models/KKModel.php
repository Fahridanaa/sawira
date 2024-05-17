<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KKModel extends Model
{
	use HasFactory;

	protected $table = 'kk';
	protected $primaryKey = 'id_kk';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'no_kk',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_kk' => 'integer',
	];

	public function akun()
	{
		return $this->belongsTo(AkunModel::class, 'id_kk', 'id_kk');
	}
}
