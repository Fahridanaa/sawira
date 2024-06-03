<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SAWRankModel extends Model
{
	use HasFactory;

	protected $table = 'saw_rank';
	protected $primaryKey = 'id_saw_rank';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id_kondisi_keluarga',
		'nilai_saw',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_saw_rank' => 'integer',
		'id_kondisi_keluarga' => 'integer',
		'nilai_saw' => 'double'
	];

	public function kondisiKeluarga()
	{
		return $this->belongsTo(KondisiKeluargaModel::class, 'id_kondisi_keluarga', 'id_kondisi_keluarga');
	}
}
