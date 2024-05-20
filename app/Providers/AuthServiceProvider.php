<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
	public static $permission = [
		'manage-citizens' => ['rw', 'rt']
	];

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

		foreach (self::$permission as $action => $roles) {
			Gate::define($action, function ($user) use ($roles) {
				if (in_array($user->role, $roles)) {
					return true;
				}
			});
		}
	}
}
