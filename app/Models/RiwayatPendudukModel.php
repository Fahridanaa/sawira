<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPendudukModel extends Model
{
	use HasFactory;

	protected $table = 'riwayat_penduduk';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'tanggal_keluar',
		'alamat_tujuan',
		'alasan_keluar',
		'surat_pindah_id',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_riwayatPenduduk' => 'integer',
		'tanggal_keluar' => 'date',
		'id_suratPindah' => 'integer',
	];

	public function suratPindah(): BelongsTo
	{
		return $this->belongsTo(SuratPindahModel::class);
	}
}
