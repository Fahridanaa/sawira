<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function index()
	{
		$breadcrumb = 'Dashboard';
		$level = 'RT';
		return view('dashboard.' . $level, ['breadcrumb' => $breadcrumb]);
	}
}
