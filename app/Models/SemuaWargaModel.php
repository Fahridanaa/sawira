<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SemuaWargaModel extends Model
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
		'asal_kota',
		'tanggal_lahir',
		'agama',
		'pendidikan_terakhir',
		'jenis_pekerjaan',
		'alamat',
		'tanggal_masuk',
		'isActive',
		'id_rt',
		'id_kk',
		'status_hubungan_warga_id',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_warga' => 'integer',
		'tanggal_lahir' => 'date',
		'tanggal_masuk' => 'date',
		'isActive' => 'boolean',
		'id_rt' => 'integer',
		'id_kk' => 'integer',
		'id_hubungan' => 'integer',
	];

	public function rT(): BelongsTo
	{
		return $this->belongsTo(RTModel::class);
	}

	public function kk(): BelongsTo
	{
		return $this->belongsTo(\App\Models\RiwayatPendudukKkModel::class);
	}

	public function statusHubunganWarga(): BelongsTo
	{
		return $this->belongsTo(StatusHubunganWargaModel::class);
	}
}
