<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHistoryRequest;
use App\Models\CitizensModel;
use App\Models\KKModel;
use App\DataTables\CitizensDataTable;
use App\Models\RiwayatWargaModel;
use App\Models\RiwayatKKModel;
use App\Services\FamilyService;
use App\Services\HistoryService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCitizenRequest;
use Dompdf\Dompdf;

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
	public function store(Request $request)
	{
		try {
			$citizenValidator = Validator::make($request->all(), (new StoreCitizenRequest)->rules());

			if ($citizenValidator->fails()) {
				return response()->json(['status' => 'error', 'message' => $citizenValidator->errors()->toArray()], 400);
			}

			DB::transaction(function () use ($citizenValidator) {
				CitizensModel::create($citizenValidator->validated());
			}, 3);

			return redirect('penduduk')->with('toast_success', 'Data Warga Berhasil Ditambah!');
		} catch (\Exception $e) {
			return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
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
	public function update(Request $request, string $citizen)
	{
		try {
			// Pass the citizen ID to the StoreCitizenRequest
			$storeCitizenRequest = new StoreCitizenRequest($citizen);
			$citizenValidator = Validator::make($request->all(), $storeCitizenRequest->rules());

			if ($citizenValidator->fails()) {
				return response()->json(['status' => 'error', 'message' => $citizenValidator->errors()->toArray()], 400);
			}

			CitizensModel::findOrFail($citizen)->update($citizenValidator->validated());
			return redirect('penduduk')->with('toast_success', 'Data Warga Berhasil Diupdate!');
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
			$citizen = RiwayatWargaModel::findOrFail($id);

			$this->historyService->uploadFile($citizen, $request);
		});

		return redirect()->back();
	}

	public function download($id)
	{
		$history = RiwayatWargaModel::findOrFail($id);

		$file = $this->historyService->downloadFile($history);
		if ($file === null) return redirect()->back()->with('toast_error', 'File not found.');
		return $file;
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function softDeleteAndAddToHistory(StoreHistoryRequest $storeHistoryRequest, $id_warga)
	{
		DB::transaction(function () use ($storeHistoryRequest, $id_warga) {
			$citizen = CitizensModel::withTrashed()->findOrFail($id_warga);
			$citizen->delete();
			 if ($citizen->id_hubungan === 1) {
				$kk = KKModel::withTrashed()->findOrFail($citizen->id_kk);
				$citizens = CitizensModel::withTrashed()->where('id_kk', $citizen->id_kk)->get();

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
					'id_kk' => $citizen->id_kk,
					'tanggal' => Carbon::now(),
					'status' => $storeHistoryRequest->status,
					'nama_lengkap' => $headOfFamily->nama_lengkap ?? 'N/A', // Simpan nama kepala keluarga,
				]);
			} else {
				$citizen->delete();

				RiwayatWargaModel::create([
					'id_warga' => $id_warga,
					'tanggal' => Carbon::now(),
					'status' => $storeHistoryRequest->status,
				]);
			}
		});
		return redirect('history')->with('toast_success', 'Data Warga Berhasil Dihapus!');
	}

	public function restore($id)
	{
		$citizenHistory = RiwayatWargaModel::findOrFail($id);
		$citizen = CitizensModel::withTrashed()->find($citizenHistory->id_warga);

		if (!$citizen || $citizenHistory->status === 'Kematian') {
			return back()->with('toast_error', 'Warga tidak ditemukan');
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

		// Restore citizens yang terkait
		// CitizensModel::withTrashed()->where('id_kk', $kk->id_kk)->restore();
		return redirect('penduduk')->with('toast_success', 'Data Warga Berhasil Dikembalikan!');
	}
}
