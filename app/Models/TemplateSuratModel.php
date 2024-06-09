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
		'nama_surat',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_template_surat' => 'integer',
	];

	public function arsipSurat()
	{
		return $this->hasMany(ArsipSuratModel::class, 'id_template_surat', 'id_template_surat');
	}
}
