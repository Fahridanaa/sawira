<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KetuaRTModel extends Model
{
	use HasFactory;

	protected $table = 'ketua_rt';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id_rt',
		'semua_warga_id',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'id_rt' => 'integer',
		'semua_warga_id' => 'integer',
	];

	public function rT(): BelongsTo
	{
		return $this->belongsTo(RTModel::class);
	}

	public function semuaWarga(): BelongsTo
	{
		return $this->belongsTo(CitizensModel::class);
	}
}
