<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiMustahikModel extends Model
{
	use HasFactory;

	protected $table = 'verifikasi_mustahik';
	protected $primaryKey = 'id_verifikasi';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'verifikasi_amil',
		'alasan_ditolak',
		'id_pengajuan_mustahik',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_pengajuan' => 'integer',
		'verifikasi_amil' => 'boolean',
		'id_pengajuan_mustahik' => 'integer',
	];
}
