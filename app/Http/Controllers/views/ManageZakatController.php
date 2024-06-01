<?php

namespace App\Http\Controllers\views;

use App\DataTables\AlternativeSPKDataTable;
use App\Http\Controllers\Controller;
use App\Models\KondisiKeluargaModel;
use App\Services\SAWService;
use Illuminate\Http\Request;
use App\Helpers\BobotConvertHelper;

class ManageZakatController extends Controller
{
	protected SAWService $SAWService;
	protected BobotConvertHelper $bobotConvertHelper;

	public function __construct(SAWService $SAWService)
	{
		$this->SAWService = $SAWService;
		$this->bobotConvertHelper = new BobotConvertHelper();
	}

	public function index(AlternativeSPKDataTable $alternativeSPKDataTable)
	{
		return view('pages.zakat.index');
	}

	public function saw(Request $request)
	{
		if (!$request->session()->has('step')) {
			$request->session()->put('step', 1);
		}

		$kkData = KondisiKeluargaModel::with(['kk' => function ($query) {
			$query->select('id_kk', 'no_kk');
		}])->take(10)->get();

		$citizensData = KondisiKeluargaModel::with(['kk.citizens' => function ($query) {
			$query->select('id_kk', 'nama_lengkap')
				->where('id_hubungan', 1)
				->first();
		}])->take(10)->get();

		$alternativeSPK = $kkData->merge($citizensData);

		$alternativeSPKConvert = $this->bobotConvertHelper->CriteriaConvert($alternativeSPK);

		$minMax = $this->SAWService->minMax($alternativeSPKConvert);

		$normalized = $this->SAWService->normalized($alternativeSPKConvert, $minMax);

		$weighted = $this->SAWService->weighted($normalized);

		$sawRank = $this->SAWService->saw($weighted);

		$step = $request->session()->get('step');

		return view('pages.zakat.saw.index', [
			'step' => $step,
			'alternativeSPK' => $alternativeSPK,
			'alternativeSPKConvert' => $alternativeSPKConvert,
			'minMax' => $minMax,
			'normalized' => $normalized,
			'weighted' => $weighted,
			'sawRank' => $sawRank
		]);
	}

	public function changeStep(Request $request, $step)
	{
		// Save the new step in the session
		$request->session()->put('step', $step);

		return redirect()->route('saw');
	}

	public function nextStep(Request $request)
	{
		$step = $request->session()->get('step', 1);

		// Increment the step
		$step++;

		// Save the new step in the session
		$request->session()->put('step', $step);

		return redirect()->route('saw');
	}

	public function previousStep(Request $request)
	{
		$step = $request->session()->get('step', 1);

		// Decrement the step
		$step--;

		// Save the new step in the session
		$request->session()->put('step', $step);

		return redirect()->route('saw');
	}

//	public function alternative(AlternativeSPKDataTable $alternativeSPKDataTable)
//	{
//		return $alternativeSPKDataTable->render('components.tables.alternative-spk');
//	}
}
