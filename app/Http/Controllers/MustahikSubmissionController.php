<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MustahikSubmissionController extends Controller
{
	public function index()
	{
//		return view('pages.mustahik_submission.index');
	}

	public function create()
	{
		return view('pages.mustahik_submission.create');
	}
}
