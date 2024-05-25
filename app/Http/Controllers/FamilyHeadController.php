<?php

namespace App\Http\Controllers;

use App\DataTables\FamilyHeadAccountDataTable;
use App\DataTables\FamilyHeadsDataTable;
use App\DataTables\FamilyInformationDataTable;
use App\Http\Requests\StoreCitizenRequest;
use App\Http\Requests\StoreFamilyCardRequest;
use App\Models\CitizensModel;
use App\Models\KKModel;
use App\Models\UsersModel;
use App\Services\CitizenService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
		$provinces = \Indonesia::allProvinces();
		return view('pages.familyHeads.create', ['provinces' => $provinces]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		try {
			$familyValidator = Validator::make($request->family, (new StoreFamilyCardRequest)->rules());

			if ($familyValidator->fails()) {
				return response()->json([
					'status' => 'error',
					'message' => $familyValidator->errors()
				], 400);
			}
			$familyData = $familyValidator->validated();

			$citizens = $request->citizens;

			DB::transaction(function () use ($familyData, $citizens) {
				$roleUser = auth()->user()->role;
				$rt = preg_replace("/[^0-9]/", "", $roleUser);
				$tanggalHariIni = Carbon::now();
				$randomUsername = Str::random(10);
				$randomPassword = Str::random(8);

				$user = UsersModel::create([
					'username' => $randomUsername,
					'password' => bcrypt($randomPassword),
					'role' => 'warga',
				]);

				$newFamily = KKModel::create(array_merge($familyData, [
					'id_user' => $user->id_user,
					'id_rt' => $rt,
					'tanggal_masuk' => $tanggalHariIni
				]));

				foreach ($citizens as $citizen) {
					$citizenValidator = Validator::make(array_merge($citizen, [
						'id_kk' => $newFamily->id_kk,
					]), (new StoreCitizenRequest)->rules());
					if ($citizenValidator->fails()) {
						return response()->json([
							'status' => 'error',
							'message' => $citizenValidator->errors()
						], 400);
					}
					CitizensModel::create($citizenValidator->validated());
				}
			}, 3);

			return response()->json(['message' => 'Successfully created family-card'], 201);
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
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
