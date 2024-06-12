<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * Generate RT roles dynamically.
	 *
	 * @return array
	 */
	protected static function generateRtRoles(): array
	{
		$rtRoles = ['rw'];
		for ($i = 1; $i <= 18; $i++) {
			$rtRoles[] = 'rt' . $i;
		}
		return $rtRoles;
	}

	/**
	 * The permissions and their associated roles.
	 *
	 * @var array
	 */
	protected static $permissions = [
		'manager' => [],
		'admin' => [],
		'user' => [],
		'amil' => []
	];

	/**
	 * Initialize the static permissions property.
	 */
	protected static function initializePermissions(): void
	{
		self::$permissions['manager'] = self::generateRtRoles();
		self::$permissions['admin'] = ['rw'];
		self::$permissions['user'] = ['warga'];
		self::$permissions['amil'] = ['amil'];
	}

	/**
	 * The model to policy mappings for the application.
	 *
	 * @var array<class-string, class-string>
	 */
	protected $policies = [
		// 'App\Models\Model' => 'App\Policies\ModelPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 */
	public function boot(): void
	{
		$this->registerPolicies();

		// Initialize permissions
		self::initializePermissions();

		foreach (self::$permissions as $action => $roles) {
			Gate::define($action, function ($user) use ($roles) {
				return in_array($user->role, $roles);
			});
		}
	}
}
