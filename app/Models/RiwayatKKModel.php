<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiwayatKKModel extends Model
{
	use HasFactory, SoftDeletes;

	protected $table = 'riwayat_kk';

	protected $primaryKey = 'id_riwayatKK';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id_kk',
		'tanggal',
		'file_surat',
		'status',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_riwayatPindahan' => 'integer',
		'id_kk' => 'integer',
		'tanggal' => 'date',
		'status' => 'string',
	];

	public function KK(): BelongsTo
	{
		return $this->belongsTo(KKModel::class, 'id_kk', 'id_kk');
	}


	public function citizens()
	{
		return $this->hasMany(CitizensModel::class, 'id_warga', 'id_warga');
	}

//	protected function file_surat(): Attribute
//	{
//		return Attribute::make(
//			get: fn($file_surat) => url("/storage/surat/" . $file_surat),
//		);
//	}
}
