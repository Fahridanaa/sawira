<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MustahikModel extends Model
{
	use HasFactory;

	protected $table = 'mustahik';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'kondisi_rumah',
		'pendapatan_bulanan',
		'pengeluaran_bulanan',
		'jumlah_hutang',
		'verifikasi',
		'id_kategori',
		'id_warga'
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_mustahik' => 'integer',
		'verifikasi' => 'boolean',
		'id_kategori' => 'integer',
		'id_warga' => 'integer'
	];

	public function kategoriMustahik(): BelongsTo
	{
		return $this->belongsTo(KategoriMustahikModel::class, 'id_kategori', 'id_kategori');
	}
}
