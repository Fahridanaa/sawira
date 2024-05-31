<?php

namespace App\Http\Controllers\views;

use App\Http\Controllers\Controller;

class ManageZakatController extends Controller
{
	public function index()
	{
		return view('pages.zakat.index');
	}
}
