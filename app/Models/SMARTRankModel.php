<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMARTRankModel extends Model
{
	use HasFactory;

	protected $table = 'smart_rank';
	protected $primaryKey = 'id_smart_rank';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id_kondisi_keluarga',
		'nilai_smart',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_smart_rank' => 'integer',
		'id_kondisi_keluarga' => 'integer',
		'nilai_smart' => 'double'
	];

	public function kondisiKeluarga()
	{
		return $this->belongsTo(KondisiKeluargaModel::class, 'id_kondisi_keluarga', 'id_kondisi_keluarga');
	}
}
