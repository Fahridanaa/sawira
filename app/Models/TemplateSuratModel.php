<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSuratModel extends Model
{
	use HasFactory;

	protected $table = 'template_surat';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'kode_surat',
		'nama_surat',
		'deskripsi_surat',
		'var_surat',
		'tgl_pembuatan',
		'isActive',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_surat' => 'integer',
		'tgl_pembuatan' => 'datetime',
		'isActive' => 'boolean',
	];
}
