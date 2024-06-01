<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiKeluargaModel extends Model
{
	use HasFactory;

	protected $table = 'kondisi_keluarga';
	protected $primaryKey = 'id_kondisi_keluarga';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id_kk',
		'kondisi_tempat_tinggal',
		'jumlah_penghasilan',
		'jumlah_pengeluaran',
		'jumlah_hutang',
		'jumlah_tanggungan',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_kk' => 'integer',
		'id_kondisi_keluarga' => 'integer',
		'kondisi_tempat_tinggal' => 'integer',
		'jumlah_penghasilan' => 'integer',
		'jumlah_pengeluaran' => 'integer',
		'jumlah_hutang' => 'integer',
		'jumlah_tanggungan' => 'integer',
	];

	public function kk()
	{
		return $this->belongsTo(KKModel::class, 'id_kk', 'id_kk');
	}
}
