<?php

namespace Database\Seeders;

use App\Models\UsersModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
	public const ROLES = ['rw', 'rt1', 'rt2', 'rt3', 'rt4', 'rt5', 'rt6', 'rt7', 'rt8', 'rt9', 'rt10', 'rt11', 'rt12', 'rt13', 'rt14', 'rt15', 'rt16', 'rt17', 'rt18', 'amil', 'warga'];

	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$userList = $this->createUserList(self::ROLES);
		foreach ($userList as $user) {
			UsersModel::create($user);
		}
		UsersModel::factory(25)->create();
	}

	/**
	 * Create a list of users from roles
	 *
	 * @param array $roles
	 * @return array
	 */
	protected function createUserList(array $roles): array
	{
		$userList = [];
		foreach ($roles as $role) {
			$userList[] = [
				'username' => $role,
				'role' => $role,
				'password' => Hash::make($role),
			];
		}
		return $userList;
	}
}
