<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanMustahikModel extends Model
{
	use HasFactory;

	protected $table = 'pengajuan_mustahik';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'verifikasi_amil',
		'alasan_ditolak',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_pengajuan' => 'integer',
		'verifikasi_amil' => 'boolean',
	];
}
