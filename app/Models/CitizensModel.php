<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CitizensModel extends Model
{
	use HasFactory;

	protected $table = 'semua_warga';
	protected $primaryKey = 'id_warga';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'nik',
		'nama_lengkap',
		'no_telp',
		'jenis_kelamin',
		'asal_tempat',
		'tanggal_lahir',
		'agama',
		'pendidikan_terakhir',
		'pekerjaan',
		'tanggal_masuk',
		'id_kk',
		'id_hubungan',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_warga' => 'integer',
		'tanggal_lahir' => 'date:Y-m-d',
		'tanggal_masuk' => 'date',
		'id_kk' => 'integer',
		'id_hubungan' => 'integer',
		'id_rt' => 'integer'
	];

	public function kk(): belongsTo
	{
		return $this->belongsTo(KKModel::class, 'id_kk', 'id_kk');
	}

	public function statusHubunganWarga(): BelongsTo
	{
		return $this->belongsTo(StatusHubunganWargaModel::class, 'id_hubungan', 'id_hubungan');
	}
}
