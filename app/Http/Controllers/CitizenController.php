<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCitizenRequest;
use App\Models\CitizensModel;
use App\Models\KKModel;
use App\DataTables\CitizensDataTable;
use App\Services\CitizenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitizenController extends Controller
{
	protected $citizenService;

	public function __construct(CitizenService $citizenService)
	{
		$this->citizenService = $citizenService;
	}

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
		$id_rt = 4;
		$no_kk = KKModel::where('id_rt', $id_rt)->get(['no_kk']);
		return view('pages.citizen.create', ['no_kk' => $no_kk]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreCitizenRequest $StoreCitizenRequest)
	{
		try {
			DB::transaction(function () use ($StoreCitizenRequest) {
				$this->citizenService->createCitizens($StoreCitizenRequest->citizens, $StoreCitizenRequest->id_kk);
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
