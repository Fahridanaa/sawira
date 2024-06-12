<?php

namespace App\Http\Controllers\views;

use App\DataTables\LetterArchivesDataTable;
use App\Http\Controllers\Controller;
use App\Models\RTModel;
use Illuminate\Http\Request;

class ManageLetterArchivesController extends Controller
{
	public function index(LetterArchivesDataTable $letterArchivesDataTable, Request $request)
	{
		$rts = RTModel::all();
		if ($request->ajax()) {
			return $letterArchivesDataTable->render('components.tables.letter-archives');
		}
		$breadcrumb = 'Arsip Surat Resmi';
		return view('pages.letterArchives.index', [
			'breadcrumb' => $breadcrumb,
			'rts' => $rts
		]);
	}
}
