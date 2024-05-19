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
		'alamat',
		'kode_pos',
		'id_akun',
		'id_provinsi',
		'id_kabupaten',
		'id_kecamatan',
		'id_kelurahan',
		'id_rt',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_kk' => 'integer',
		'id_user' => 'integer',
		'id_provinsi' => 'integer',
		'id_kabupaten' => 'integer',
		'id_kecamatan' => 'integer',
		'id_kelurahan' => 'integer',
		'id_rt' => 'integer',
	];

	public function user()
	{
		return $this->belongsTo(UsersModel::class, 'id_akun', 'id_akun');
	}

	public function provinsi()
	{
		return $this->hasOne(IndonesiaProvincesModel::class, 'id', 'id_provinsi');
	}

	public function kabupaten()
	{
		return $this->hasOne(IndonesiaCitiesModel::class, 'id', 'id_kabupaten');
	}

	public function kecamatan()
	{
		return $this->hasOne(IndonesiaDistrictsModel::class, 'id', 'id_kecamatan');
	}

	public function kelurahan()
	{
		return $this->hasOne(IndonesiaVillagesModel::class, 'id', 'id_kelurahan');
	}

	public function rt()
	{
		return $this->hasOne(RTModel::class, 'id_rt', 'id_rt');
	}
}
