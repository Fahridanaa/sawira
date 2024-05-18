<?php

namespace App\Http\Controllers;
use App\Models\KKModel;
use App\DataTables\CitizensDataTable;
use Illuminate\Http\Request;

class CitizenController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(CitizensDataTable $citizensDataTable)
	{
		return $citizensDataTable->render('components.tables.citizens');
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$id_rt = 4; // Ganti 1 dengan nilai id_rt yang diinginkan
		$no_kk = KKModel::where('id_rt', $id_rt)->get(['no_kk']);
		return view('pages.citizen.create', ['no_kk' => $no_kk]);
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
	public function show(string $id)
	{
		//
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
