<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatSuratModel extends Model
{
	use HasFactory;

	protected $table = 'riwayat_surat';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'data_surat',
		'template_surat_id',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_riwayatSurat' => 'integer',
		'id_surat' => 'integer',
	];

	public function templateSurat(): BelongsTo
	{
		return $this->belongsTo(TemplateSuratModel::class);
	}
}
