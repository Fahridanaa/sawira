<?php

namespace App\Http\Controllers\views;

use App\DataTables\CitizensHistoryDataTable;
use App\DataTables\FamilyHistoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\RTModel;
use Illuminate\Http\Request;

class ManageHistoryController extends Controller
{
	public function index(Request $request)
	{
//		$rw = RiwayatKKModel::with('kk')->get()->pluck('kk.id_rt')->filter()->unique()->sort();
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
}
