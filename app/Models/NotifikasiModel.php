<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotifikasiModel extends Model
{
	use HasFactory;

	protected $table = 'notifikasi';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'jenis_notifikasi',
		'tanggal_notifikasi',
		'id_akun',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_notifikasi' => 'integer',
		'tanggal_notifikasi' => 'date',
		'id_akun' => 'integer',
	];

	public function akun(): BelongsTo
	{
		return $this->belongsTo(AkunModel::class);
	}
}
