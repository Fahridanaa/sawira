<?php

namespace App\Http\Controllers\views;

use App\DataTables\FamilyHistoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\RiwayatKKModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FamilyHistoryController extends Controller
{
	public function index(FamilyHistoryDataTable $familyHistoryDataTable, Request $request)
	{
		if ($request->has('id_rt')) {
			$id_rt = $request->input('id_rt');
			$familyHistory = RiwayatKKModel::whereHas('KK', function ($query) use ($id_rt) {
				$query->withTrashed()->where('id_rt', $id_rt);
			})->get();

			return $familyHistoryDataTable->render('components.tables.family-history', compact('familyHistory'));
		}
		return $familyHistoryDataTable->render('components.tables.family-history');
	}

	public function download($id)
	{
		$history = RiwayatKKModel::findOrFail($id);

		if ($history->file_surat) {
			return Storage::download($history->file_surat);
		} else {
			return redirect()->back()->with('error', 'File not found.');
		}
	}
}
