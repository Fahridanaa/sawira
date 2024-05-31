<?php

namespace App\Http\Controllers\views;

use App\DataTables\CitizensHistoryDataTable;
use App\DataTables\FamilyHistoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\RiwayatKKModel;
use App\Models\RiwayatWargaModel;
use App\Models\RTModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManageHistoryController extends Controller
{
	public function index(Request $request)
	{
		$rts = RTModel::all();

		if ($request->ajax()) {
			$citizensHistory = new CitizensHistoryDataTable();
			$moveHistory = new FamilyHistoryDataTable();
			$data = [
				'citizensTable' => $citizensHistory->render('components.tables.citizens-history'),
				'familyHeadsTable' => $moveHistory->render('components.tables.move-history'),
			];
			return response()->json($data);
		}

		$breadcrumb = 'Riwayat Penduduk';
		return view('pages.history.index', ['breadcrumb' => $breadcrumb], compact('rts'));
	}

	public function citizen(CitizensHistoryDataTable $citizensHistoryDataTable, Request $request)
	{
		if ($request->has('id_rt')) {
			$id_rt = $request->input('id_rt');
			$citizensHistory = RiwayatWargaModel::whereHas('warga.kk', function ($query) use ($id_rt) {
				$query->where('id_rt', $id_rt);
			})->get();

			return $citizensHistoryDataTable->render('components.tables.citizens-history', compact('citizensHistory'));
		}
		return $citizensHistoryDataTable->render('components.tables.citizens-history');
	}

	public function family(FamilyHistoryDataTable $familyHistoryDataTable, Request $request)
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
