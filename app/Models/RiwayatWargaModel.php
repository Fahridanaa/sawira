<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatWargaModel extends Model
{
	use HasFactory;

	protected $table = 'riwayat_warga';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'kategori_riwayat',
		'id_warga',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_riwayatWarga' => 'integer',
		'id_warga' => 'integer',
	];

	public function warga(): BelongsTo
	{
		return $this->belongsTo(CitizensModel::class, 'id_warga', 'id_warga');
	}
}
