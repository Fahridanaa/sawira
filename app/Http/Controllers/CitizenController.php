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
		$roleUser = auth()->user()->role;
		$rt = preg_replace("/[^0-9]/", "", $roleUser);

		$kkRecords = KKModel::with(['citizens' => function ($query) {
			$query->where('id_hubungan', 1);
		}])->where('id_rt', $rt)->get();

		$headFamilyRecords = $kkRecords->mapWithKeys(function ($kkRecord) {
			return [$kkRecord['id_kk'] => $kkRecord->citizens->first()->nama_lengkap];
		});

		return view('pages.citizen.create', ['kkRecords' => $kkRecords, 'headFamilyRecords' => json_encode($headFamilyRecords)]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		try {
			$citizensData = $request->input('citizens');
			$id_kk = $request->input('id_kk');

			validator($citizensData, (new StoreCitizenRequest)->rules());

			DB::transaction(function () use ($citizensData, $id_kk) {
				$this->citizenService->createCitizens($citizensData, $id_kk);
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
