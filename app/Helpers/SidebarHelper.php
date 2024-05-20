<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class SidebarHelper
{
	public static function hasAnyRole($roles)
	{
		foreach ($roles as $role) {
			if (Auth::user() && Auth::user()->hasRole($role)) {
				return true;
			}
		}
		return false;
	}
}