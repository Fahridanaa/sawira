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
				'username' => 'rw',
				'role' => 'rw',
				'password' => Hash::make('rw'),
			],
			[
				'username' => 'rt',
				'role' => 'rt',
				'password' => Hash::make('rt'),
			],
			[
				'username' => 'amil',
				'role' => 'amil',
				'password' => Hash::make('amil'),
			],
			[
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
