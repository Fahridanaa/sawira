<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageZakatController extends Controller
{
	public function index()
	{
		return view('pages.zakat.index');
	}
}
