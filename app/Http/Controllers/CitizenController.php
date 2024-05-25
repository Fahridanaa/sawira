<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCitizenRequest;
use App\Models\CitizensModel;
use App\Models\KKModel;
use App\DataTables\CitizensDataTable;
use App\Services\FamilyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitizenController extends Controller
{
	protected FamilyService $familyService;

	public function __construct()
	{
		$this->familyService = new FamilyService();
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index(CitizensDataTable $citizensDataTable, Request $request)
	{
		if ($request->has('id_rt')) {
			$id_rt = $request->input('id_rt');
			$citizens = CitizensModel::whereHas('kk', function ($query) use ($id_rt) {
				$query->where('id_rt', $id_rt);
			})->get();

			return $citizensDataTable->render('components.tables.citizens', compact('citizens'));
		}
		return $citizensDataTable->render('components.tables.citizens');
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$roleUser = auth()->user()->role;
		$rt = preg_replace("/[^0-9]/", "", $roleUser);

		$records = $this->familyService->getKKRecords($rt);

		$kkRecords = $records['kkRecords'];
		$headFamilyRecords = $records['headFamilyRecords'];

		return view('pages.citizen.create', ['kkRecords' => $kkRecords, 'headFamilyRecords' => json_encode($headFamilyRecords)]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreCitizenRequest $storeCitizenRequest)
	{
		try {
			DB::transaction(function () use ($storeCitizenRequest) {
				CitizensModel::create($storeCitizenRequest->validated());
			}, 3);
			return response()->json(['message' => 'Successfully created citizens'], 201);
		} catch (\Exception $e) {
			return response()->json([
				'status' => 'error',
				'message' => $e->getMessage()
			], 400);
		}
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		$citizen = CitizensModel::find($id);
		return response()->json($citizen);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$citizen = CitizensModel::findOrFail($id);
		$roleUser = auth()->user()->role;
		$rt = preg_replace("/[^0-9]/", "", $roleUser);

		$records = $this->familyService->getKKRecords($rt);

		$kkRecords = $records['kkRecords'];
		$headFamilyRecords = $records['headFamilyRecords'];
		return view('pages.citizen.edit', ['citizen' => $citizen, 'kkRecords' => $kkRecords, 'headFamilyRecords' => json_encode($headFamilyRecords)]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(StoreCitizenRequest $request, string $id)
	{
		CitizensModel::find($id)->update($request->validated());
		return response()->json(['message' => 'Successfully updated citizens'], 201);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
