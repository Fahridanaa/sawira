<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiwayatWargaModel extends Model
{
	use HasFactory, SoftDeletes;

	protected $table = 'riwayat_warga';
	protected $primaryKey = 'id_riwayatWarga';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id_warga',
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
		'id_riwayatWarga' => 'integer',
		'id_warga' => 'integer',
		'tanggal' => 'date',
		'status' => 'string',
	];

	public function warga(): BelongsTo
	{
		return $this->belongsTo(CitizensModel::class, 'id_warga', 'id_warga')->withTrashed();
	}
}
