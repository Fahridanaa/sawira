<?php

namespace App\Http\Controllers;

use App\DataTables\FamilyHeadsDataTable;
use App\DataTables\FamilyInformationDataTable;
use App\Http\Requests\StoreCitizenRequest;
use App\Http\Requests\StoreFamilyCardRequest;
use App\Http\Requests\StoreHistoryRequest;
use App\Models\CitizensModel;
use App\Models\KKModel;
use App\Models\KondisiKeluargaModel;
use App\Models\RiwayatKKModel;
use App\Models\RiwayatWargaModel;
use App\Models\UsersModel;
use App\Services\HistoryService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FamilyController extends Controller
{
	protected HistoryService $historyService;

	public function __construct()
	{
		$this->historyService = new HistoryService();
	}

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
	public function create($id = null)
	{
		$citizen = ($id) ? CitizensModel::where('id_warga', $id)->first() : null;
		$provinces = \Indonesia::allProvinces();
		return view('pages.familyHeads.create', ['provinces' => $provinces], compact('citizen'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$index = 0;
		$errors = [];

		try {
			// Validate family data
			$familyValidator = Validator::make($request->family, (new StoreFamilyCardRequest)->rules());
			if ($familyValidator->fails()) {
				$errors['family'] = $familyValidator->errors()->toArray();
			}

			// Validate citizens data without id_kk
			$citizens = $request->citizens;
			$citizenRules = (new StoreCitizenRequest)->rules();
			unset($citizenRules['id_kk']); // Remove id_kk rule temporarily
			foreach ($citizens as $i => $citizen) {
				$citizenValidator = Validator::make($citizen, $citizenRules);
				if ($citizenValidator->fails()) {
					$errors['citizens'][$i] = $citizenValidator->errors()->toArray();
				}
			}

			// If any errors found, return immediately
			if (!empty($errors)) {
				return response()->json(['status' => 'error', 'message' => $errors], 400);
			}

			DB::transaction(function () use ($familyValidator, $citizens, &$index) {
				$familyData = $familyValidator->validated();

				// Create user
				$roleUser = auth()->user()->role;
				$rt = preg_replace("/[^0-9]/", "", $roleUser);
				$tanggalHariIni = Carbon::now();
				$randomUsername = Str::random(8);

				$user = UsersModel::create([
					'username' => $randomUsername,
					'password' => bcrypt($randomUsername),
					'role' => 'warga',
				]);

				// Create family
				$newFamily = KKModel::create(array_merge($familyData, [
					'id_user' => $user->id_user,
					'id_rt' => $rt,
					'tanggal_masuk' => $tanggalHariIni,
				]));

				KondisiKeluargaModel::create([
					'id_kk' => $newFamily->id_kk,
				]);

				// Validate and create each citizen with id_kk
				foreach ($citizens as $citizen) {
					$citizenValidator = Validator::make(array_merge($citizen, [
						'id_kk' => $newFamily->id_kk,
					]), (new StoreCitizenRequest)->rules());

					if ($citizenValidator->fails()) {
						throw new \Exception(json_encode($citizenValidator->errors()->toArray()));
					}

					if (isset($citizen['id_warga'])) {
						CitizensModel::findOrFail($citizen['id_warga'])->delete();
					}

					CitizensModel::create($citizenValidator->validated());
					$index++;
				}

				return redirect('penduduk')->with('toast_success', 'Data Keluarga Berhasil Ditambah!');
			}, 3);

			return response()->json(['message' => 'Successfully created family-card'], 201);
		} catch (\Exception $e) {
			$errors['citizens'][$index] = json_decode($e->getMessage(), true);
			return response()->json(['status' => 'error', 'message' => $errors], 400);
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
		$family = KKModel::findOrFail($id);
		$provinces = \Indonesia::allProvinces();
		$province = \Indonesia::findProvince($family->id_provinsi);
		$cities = \Indonesia::findCity($family->id_kabupaten);
		$districts = \Indonesia::findDistrict($family->id_kecamatan);
		$villages = \Indonesia::findVillage($family->id_kelurahan);
		return view('pages.familyHeads.edit', [
			'provinces' => $provinces,
			'province' => $province,
			'cities' => $cities,
			'districts' => $districts,
			'villages' => $villages
		], compact('family'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		try {
			$storeFamilyCardRequest = new StoreFamilyCardRequest($id);
			$familyValidator = Validator::make($request->all(), $storeFamilyCardRequest->rules());

			if ($familyValidator->fails()) {
				return response()->json(['status' => 'error', 'message' => $familyValidator->errors()->toArray()], 400);
			}

			KKModel::findOrFail($id)->update($familyValidator->validated());
			return redirect('penduduk')->with('toast_success', 'Data Kartu Keluarga Berhasil Diupdate!');
		} catch (\Exception $e) {
			return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
		}
	}

	public function upload(Request $request, string $id)
	{
		$request->validate([
			'file_surat' => 'required|file',
		]);

		DB::transaction(function () use ($request, $id) {
			$family = RiwayatKKModel::findOrFail($id);

			$this->historyService->uploadFile($family, $request);
		});

		return redirect()->back();
	}

	public function download($id)
	{
		$history = RiwayatKKModel::findOrFail($id);

		$file = $this->historyService->downloadFile($history);

		if ($file === null) return back()->with('toast_error', 'File tidak ditemukan');
		return $file;
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function softDeleteAndAddToHistory(StoreHistoryRequest $storeHistoryRequest, $id_kk)
	{
		DB::transaction(function () use ($storeHistoryRequest, $id_kk) {
			$kk = KKModel::withTrashed()->findOrFail($id_kk);
			$citizens = CitizensModel::withTrashed()->where('id_kk', $id_kk)->get();

			$headOfFamily = $citizens->where('id_hubungan', 1)->first();

			foreach ($citizens as $citizen) {
				$citizen->delete();

				RiwayatWargaModel::create([
					'id_warga' => $citizen->id_warga,
					'tanggal' => Carbon::now(),
					'status' => $storeHistoryRequest->status,
				]);
			}
			$kk->delete();

			RiwayatKKModel::create([
				'id_kk' => $id_kk,
				'tanggal' => Carbon::now(),
				'status' => $storeHistoryRequest->status,
				'nama_lengkap' => $headOfFamily->nama_lengkap ?? 'N/A', // Simpan nama kepala keluarga,
			]);
		});
		return redirect('history')->with('toast_success', 'Data Keluarga Berhasil Dihapus!');
	}

	public function restore($id)
	{
		$kkHistory = RiwayatKKModel::findOrFail($id);
		$kk = KKModel::withTrashed()->find($kkHistory->id_kk);

		if (!$kk || $kkHistory->status === 'Kematian') {
			return back()->with('toast_error', 'Data tidak ditemukan');
		}

		if ($kk->file_surat) {
			Storage::delete('public/surat/' . $kkHistory->file_surat);
		}
		$kkHistory->delete();
		$kk->restore();

		// Restore citizens yang terkait
		CitizensModel::withTrashed()->where('id_kk', $kk->id_kk)->restore();
		return redirect('penduduk')->with('toast_success', 'Data Keluarga Berhasil Dikembalikan!');
	}

}
