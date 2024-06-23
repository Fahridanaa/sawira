<?php

namespace App\Http\Controllers\views;

use App\DataTables\CitizensDataTable;
use App\DataTables\FamilyHeadsDataTable;
use App\Http\Controllers\Controller;
use App\Models\RTModel;
use Illuminate\Http\Request;

class ManageCitizens extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		try {
			$rts = RTModel::all();

			if ($request->ajax()) {
				$dataTable = new CitizensDataTable;
				$familyHeads = new FamilyHeadsDataTable;
				$data = [
					'citizensTable' => $dataTable->render('components.tables.citizens'),
					'familyHeadsTable' => $familyHeads->render('components.tables.family-heads'),
				];
				return response()->json($data);
			}

			$breadcrumb = 'Kelola Penduduk';
			return view('pages.manageCitizens.index', ['breadcrumb' => $breadcrumb], compact('rts'));
		} catch (\Exception $e) {
			return back()->with('toast_error', 'Terjadi kesalahan saat memuat data warga!');
		}
	}
}
