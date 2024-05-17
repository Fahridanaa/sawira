<?php

namespace App\Http\Controllers;

use App\DataTables\FamilyHeadsDataTable;
use App\DataTables\FamilyInformationDataTable;
use App\Models\CitizensModel;
use Illuminate\Http\Request;

class FamilyHeadController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(FamilyHeadsDataTable $familyHeadDataTable)
	{
		return $familyHeadDataTable->render('components.tables.family-heads');
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('pages.familyHeads.create');
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
		$penduduk = CitizensModel::with(['kk:id_kk'])->where('id_kk', $dataTable->id_kk)->get();
		return $dataTable->render('pages.manageCitizens.show', ['penduduk' => $penduduk]);
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
