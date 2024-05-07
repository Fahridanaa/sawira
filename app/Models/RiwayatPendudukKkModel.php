<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPendudukKkModel extends Model
{
	use HasFactory;

	protected $table = 'riwayat_penduduk_kk';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id_kk',
		'riwayat_penduduk_id',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'id_kk' => 'integer',
		'id_riwayatPenduduk' => 'integer',
	];

	public function kK(): BelongsTo
	{
		return $this->belongsTo(KKModel::class);
	}

	public function riwayatPenduduk(): BelongsTo
	{
		return $this->belongsTo(RiwayatPendudukModel::class);
	}
}
