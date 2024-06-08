<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCitizenHistoryRequest;
use App\Http\Requests\StoreCitizenRequest;
use App\Http\Requests\StoreHistoryRequest;
use App\Models\CitizensModel;
use App\Models\KKModel;
use App\DataTables\CitizensDataTable;
use App\Models\RiwayatWargaModel;
use App\Services\FamilyService;
use App\Services\HistoryService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CitizenController extends Controller
{
	protected FamilyService $familyService;
	protected HistoryService $historyService;

	public function __construct()
	{
		$this->familyService = new FamilyService();
		$this->historyService = new HistoryService();
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

	public function upload(Request $request, string $id)
	{
		$request->validate([
			'file_surat' => 'required|file',
		]);

		DB::transaction(function () use ($request, $id) {
			$citizen = RiwayatWargaModel::findOrFail($id);

			$this->historyService->uploadFile($citizen, $request);
		});

		return redirect()->back();
	}

	public function download($id)
	{
		$history = RiwayatWargaModel::findOrFail($id);

		$file = $this->historyService->downloadFile($history);
		if ($file === null) return redirect()->back()->with('error', 'File not found.');
		return $file;
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function softDeleteAndAddToHistory(StoreHistoryRequest $storeHistoryRequest, $id_warga)
	{
		DB::transaction(function () use ($storeHistoryRequest, $id_warga) {
			$citizen = CitizensModel::findOrFail($id_warga);
			if ($citizen->id_hubungan === 1) {
				$kk = KKModel::findOrFail($citizen->id_kk);
				$kk->delete();
			}
			$citizen->delete();

			RiwayatWargaModel::create([
				'id_warga' => $id_warga,
				'tanggal' => Carbon::now(),
				'status' => $storeHistoryRequest->status,
			]);
		});
		return redirect()->route('history');
	}

	public function restore($id)
	{
		$citizenHistory = RiwayatWargaModel::findOrFail($id);
		$citizen = CitizensModel::withTrashed()->find($citizenHistory->id_warga);

		if (!$citizen || $citizenHistory->status === 'Kematian') {
			return response()->json(['message' => 'Citizen not found'], 404);
		}

		if ($citizen->file_surat) {
			Storage::delete('public/surat/' . $citizenHistory->file_surat);
		}
		
		if ($citizen->id_hubungan === 1) {
			$kk = KKModel::withTrashed()->findOrFail($citizen->id_kk);
			$kk->restore();
		}
		$citizen->restore();
		$citizenHistory->delete();
		return redirect()->route('penduduk');

	}
}
