<?php

namespace App\Http\Controllers;

use App\Helpers\BobotConvertHelper;
use App\Models\KondisiKeluargaModel;
use App\Services\SAWService;
use Illuminate\Http\Request;

class SAWController extends Controller
{
	protected SAWService $SAWService;
	protected BobotConvertHelper $bobotConvertHelper;

	public function __construct(SAWService $SAWService)
	{
		$this->SAWService = $SAWService;
		$this->bobotConvertHelper = new BobotConvertHelper();
	}

	public function index(Request $request)
	{
		if (!$request->session()->has('sawStep')) {
			$request->session()->put('sawStep', 1);
		}

		$sawStep = $request->session()->get('sawStep');

		if (!$request->session()->has('alternativeSPK')) {
			$kkData = KondisiKeluargaModel::with(['kk' => function ($query) {
				$query->select('id_kk', 'no_kk');
			}])->take(10)->get();

			$citizensData = KondisiKeluargaModel::with(['kk.citizens' => function ($query) {
				$query->select('id_kk', 'nama_lengkap')
					->where('id_hubungan', 1);
			}])->take(10)->get();

			$alternativeSPK = $kkData->merge($citizensData)->toArray();
			$request->session()->put('alternativeSPK', $alternativeSPK);

			$alternativeSPKConvert = $this->bobotConvertHelper->CriteriaConvert($alternativeSPK);
			$request->session()->put('alternativeSPKConvert', $alternativeSPKConvert);

			$minMax = $this->SAWService->minMax($alternativeSPKConvert);
			$request->session()->put('minMax', $minMax);

			$normalized = $this->SAWService->normalized($alternativeSPKConvert, $minMax);
			$request->session()->put('normalized', $normalized);

			$weighted = $this->SAWService->weighted($normalized);
			$request->session()->put('weighted', $weighted);

			$sawRank = $this->SAWService->saw($weighted);
			$request->session()->put('sawRank', $sawRank);
		} else {
			$alternativeSPK = $request->session()->get('alternativeSPK');
			$alternativeSPKConvert = $request->session()->get('alternativeSPKConvert');
			$minMax = $request->session()->get('minMax');
			$normalized = $request->session()->get('normalized');
			$weighted = $request->session()->get('weighted');
			$sawRank = $request->session()->get('sawRank');
		}

		return view('pages.zakat.saw.index', [
			'step' => $sawStep,
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
		$request->session()->put('sawStep', $step);

		return redirect()->route('saw');
	}

	public function nextStep(Request $request)
	{
		$step = $request->session()->get('sawStep', 1);

		// Increment the step
		$step++;
		if ($step === 8) {
			return redirect()->route('zakat.index');
		}

		// Save the new step in the session
		$request->session()->put('sawStep', $step);

		return redirect()->route('saw');
	}

	public function previousStep(Request $request)
	{
		$step = $request->session()->get('sawStep', 1);

		// Decrement the step
		$step--;
		if ($step === 0) {
			return redirect()->route('saw');
		}

		// Save the new step in the session
		$request->session()->put('sawStep', $step);

		return redirect()->route('saw');
	}
}
