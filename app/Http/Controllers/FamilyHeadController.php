<?php

namespace App\Http\Controllers;

use App\DataTables\FamilyHeadAccountDataTable;
use App\DataTables\FamilyHeadsDataTable;
use App\DataTables\FamilyInformationDataTable;
use App\Models\CitizensModel;
use App\Models\KKModel;
use Illuminate\Http\Request;

class FamilyHeadController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(FamilyHeadsDataTable $familyHeadDataTable, Request $request)
	{
		if ($request->has('id_rt')) {
			$id_rt = $request->input('id_rt');
			$familyHeads = KKModel::where('id_rt', $id_rt)->get();
		} else {
			// Handle case where no id_rt is provided (optional)
			$familyHeads = KKModel::all(); // Or fetch all family heads if no filter is applied
		}
	
		return $familyHeadDataTable->render('components.tables.family-heads', compact('familyHeads'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$provinces = \Indonesia::allProvinces();
		return view('pages.familyHeads.create', ['provinces' => $provinces]);
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
	public function show(string $id, FamilyInformationDataTable $dataTable)
	{
		$dataTable->id_kk = $id;
		return $dataTable->render('pages.manageCitizens.show');
	}

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
