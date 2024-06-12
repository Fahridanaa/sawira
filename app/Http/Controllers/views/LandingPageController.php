<?php

namespace App\Http\Controllers\views;

use App\Http\Controllers\Controller;

class LandingPageController extends Controller
{
	public function index()
	{
		return view('pages.landing-page.index');
	}
}
