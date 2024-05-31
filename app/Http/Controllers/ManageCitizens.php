<?php

namespace App\Http\Controllers;

use App\DataTables\FamilyHeadsDataTable;
use App\DataTables\FamilyInformationDataTable;
use App\DataTables\CitizensDataTable;
use App\Models\CitizensModel;
use App\Models\KKModel;
use App\Models\RTModel;
use Illuminate\Http\Request;

class ManageCitizens extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		// Mengambil semua id_rt dari tabel kk melalui relasi citizens tanpa duplikat
//		$rw = CitizensModel::with('kk')->get()->pluck('kk.id_rt')->filter()->unique()->sort();
		$rts = RTModel::all();

		if ($request->ajax()) {
			$dataTable = new CitizensDataTable;
			$familyHeads = new FamilyHeadsDataTable;
			$data = [
				'citizensTable' => $dataTable->render('components.tables.Citizen'),
				'familyHeadsTable' => $familyHeads->render('components.tables.family-heads'),
			];
			return response()->json($data);
		}

		$breadcrumb = 'Kelola Penduduk';
		return view('pages.manageCitizens.index', ['breadcrumb' => $breadcrumb], compact('rts'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$breadcrumb = 'Detail Penduduk';
		return view('pages.manageCitizens.show', ['breadcrumb' => $breadcrumb]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
//	public function show(string $id, FamilyInformationDataTable $dataTable)
//	{
//		$dataTable->id_kk = $id;
//		$penduduk = CitizensModel::with(['kk:id_kk'])->where('id_kk', $dataTable->id_kk)->get();
//		return $dataTable->render('pages.manageCitizens.show', ['penduduk' => $penduduk]);
//	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
