<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class historyCitizensController extends Controller
{
	public function index()
	{
		return view('pages.history.citizens.RT');
	}
}
