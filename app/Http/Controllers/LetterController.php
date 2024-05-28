<?php

namespace App\Http\Controllers;

use App\DataTables\LetterDataTable;
use App\Models\ArsipSuratModel;
use App\Models\CitizensModel;
use App\Services\LetterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LetterController extends Controller
{
	protected LetterService $letterService;

	/**
	 * Create a new controller instance.
	 */
	public function __construct()
	{
		$this->letterService = new LetterService();
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index(LetterDataTable $letterDataTable)
	{
		$id_user = auth()->user()->id_user;

		$citizens = (new CitizensModel())->with(['kk', 'kk.user'])->select('warga.*')
			->whereHas('kk', function ($query) use ($id_user) {
				$query->where('id_user', $id_user);
			})->get();

		return $letterDataTable->render('pages.letter.index', compact('citizens'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		try {
			$response = DB::transaction(function () use ($request) {
				$id_user = auth()->user()->id_user;
				$dateToday = date('Y-m-d');
				$dataSurat = $this->letterService->semicolonArrayString($request->data_surat);

				$newSurat = ArsipSuratModel::create([
					'id_user' => $id_user,
					'id_template_surat' => $request->jenis_surat,
					'tanggal_pengajuan' => $dateToday,
					'data_surat' => $dataSurat
				]);

				$letterData = array_merge($request->all(), $newSurat->toArray());
				return $this->letterService->storeLetter($letterData); // Return the response from the transaction
			});

			return $response; // Return the response from the storeLetter method
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
