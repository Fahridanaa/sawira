<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMustahikModel extends Model
{
	use HasFactory;

	protected $table = 'kategori_mustahik';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'nama_kategori',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_kategori' => 'integer',
	];

	public function mustahik()
	{
		return $this->hasMany(MustahikModel::class, 'id_kategori', 'id_kategori');
	}

	public function pengajuanMustahik()
	{
		return $this->hasMany(PengajuanMustahikModel::class, 'id_kategori', 'id_kategori');
	}
}
