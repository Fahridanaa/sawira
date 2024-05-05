<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerifikasiMustahikModel extends Model
{
	use HasFactory;

	protected $table = 'verifikasi_mustahik';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'mustahik_id',
		'pengajuan_mustahik_id',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'id_mustahik' => 'integer',
		'id_pengajuan' => 'integer',
	];

	public function mustahik(): BelongsTo
	{
		return $this->belongsTo(MustahikModel::class);
	}

	public function pengajuanMustahik(): BelongsTo
	{
		return $this->belongsTo(PengajuanMustahikModel::class);
	}
}
