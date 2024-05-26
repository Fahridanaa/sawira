<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	public function index()
	{
		return view('auth.login');
	}

	public function settings()
	{
		return view('auth.settings');
	}

	public function updatePassword(Request $request)
	{
		$request->validate([
			'old_password' => 'required',
			'new_password' => 'required',
			'confirm_password' => 'required|same:new_password',
		]);

		$user = Auth::user();
		$user->password = Hash::make($request->confirm_password);
		$user->save();

		return redirect()->back()->with('success', 'Password updated successfully');
	}

	public function updateUsername(Request $request)
	{
		$request->validate([
			'new_username' => 'required',
		]);

		$user = Auth::user();
		$user->username = $request->new_username;
		$user->save();

		return redirect()->back()->with('success', 'Username updated successfully');
	}
}
