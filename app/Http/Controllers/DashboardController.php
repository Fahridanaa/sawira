<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function index()
	{
		$level = 'rt';
		return view('dashboard.' . $level);
	}
}
