<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UsersModel extends Authenticatable
{
	use HasFactory;
	use Notifiable;

	protected $table = 'users';
	protected $primaryKey = 'id_user';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'username',
		'password',
		'level_id',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id_user' => 'integer',
		'level_id' => 'integer',
	];

	public function kk(): HasOne
	{
		return $this->hasOne(KKModel::class, 'id_akun', 'id_akun');
	}

	public function level(): BelongsTo
	{
		return $this->belongsTo(LevelModel::class);
	}
}
