<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPindahModel extends Model
{
	use HasFactory;

	protected $table = 'riwayat_pindah';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id_kk',
		'id_suratPindah',
		'tgl_keluar',
		'surat_pindah',
		'alamat_tujuan',
		'alasan_keluar'
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'id_kk' => 'integer',
		'id_suratPindah' => 'integer',
		'tgl_keluar' => 'date'
	];

	public function kK(): BelongsTo
	{
		return $this->belongsTo(KKModel::class);
	}

	public function suratPindah(): BelongsTo
	{
		return $this->belongsTo(SuratPindahModel::class);
	}
}
