<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
		$validator = Validator::make($request->all(), [
			'old_password' => 'required',
			'new_password' => 'required',
			'confirm_password' => 'required|same:new_password',
		]);

		if ($validator->fails()) {
			return back()->withErrors($validator);
		}

		$user = Auth::user();
		$user->password = Hash::make($request->confirm_password);
		$user->save();

		return back()->with('toast_success', 'Password updated successfully');
	}

	public function updateUsername(Request $request)
	{
		$request->validate([
			'new_username' => 'required',
		]);

		$user = Auth::user();
		$user->username = $request->new_username;
		$user->save();

		return back()->with('success', 'Username updated successfully');
	}

	public function resetPassword($id)
	{
		$user = UsersModel::findOrFail($id);
		$password = Str::random(8);
		$user->password = Hash::make($password);
		$user->save();
		return redirect('penduduk')->with('success', 'Password baru: ' . $password);
	}
}
