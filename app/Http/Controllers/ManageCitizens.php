<?php

namespace App\Http\Controllers;

use App\DataTables\CitizensDataTable;
use Illuminate\Http\Request;

class ManageCitizens extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(CitizensDataTable $dataTable)
	{
		$breadcrumb = 'Kelola Penduduk';
		return $dataTable->render('pages.manageCitizens.RT', ['breadcrumb' => $breadcrumb]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('pages.manageCitizens.create');
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
