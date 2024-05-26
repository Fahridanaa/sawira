<?php

namespace App\Http\Controllers;

use App\DataTables\CitizensHistoryDataTable;
use App\DataTables\MoveHistoryDataTable;
use App\Models\CitizensModel;
use Illuminate\Http\Request;
use App\Models\RiwayatWargaModel;
use App\Models\RiwayatPindahModel;

class ManageHistoryController extends Controller
{
	public function index(Request $request)
	{
		// Mengambil semua id_rt dari tabel kk melalui relasi citizens tanpa duplikat
		$rw = RiwayatPindahModel::with('kk')->get()->pluck('kk.id_rt')->filter()->unique()->sort();

		if ($request->ajax()) {
			$citizensHistory = new CitizensHistoryDataTable();
			$moveHistory = new MoveHistoryDataTable();
			$data = [
				'citizensTable' => $citizensHistory->render('components.tables.citizens-history'),
				'familyHeadsTable' => $moveHistory->render('components.tables.move-history'),
			];
			return response()->json($data);
		}

		$breadcrumb = 'Riwayat Penduduk';
		return view('pages.history.citizens.RT', ['breadcrumb' => $breadcrumb], compact('rw'));
	}
}
