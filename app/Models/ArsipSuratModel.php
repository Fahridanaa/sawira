<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArsipSuratModel extends Model
{
	use HasFactory;

	protected $table = 'arsip_surat';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id_user',
		'id_template_surat',
		'id_warga',
		'data_surat',
		'tanggal_pengajuan',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_arsip_surat' => 'integer',
		'id_template_surat' => 'integer',
		'id_user' => 'integer',
		'id_warga' => 'integer',
	];

	public function templateSurat(): BelongsTo
	{
		return $this->belongsTo(TemplateSuratModel::class, 'id_template_surat', 'id_template_surat');
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class, 'id_user', 'id_user');
	}
}
