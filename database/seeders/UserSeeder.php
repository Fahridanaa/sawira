<?php

namespace Database\Seeders;

use App\Models\UsersModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$userList = [
			[
				'id_level' => 1,
				'username' => 'rw',
				'password' => Hash::make('rw'),
			],
			[
				'id_level' => 2,
				'username' => 'rt',
				'password' => Hash::make('rt'),
			],
			[
				'id_level' => 3,
				'username' => 'amil',
				'password' => Hash::make('amil'),
			],
			[
				'id_level' => 4,
				'username' => 'warga',
				'password' => Hash::make('warga'),
			],
		];
		foreach ($userList as $user) {
			UsersModel::create($user);
		}
		UsersModel::factory(25)->create();
	}
}
