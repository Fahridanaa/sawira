<?php

namespace App\Http\Controllers;

use App\Helpers\BobotConvertHelper;
use App\Services\SAWService;
use App\Services\ZakatService;
use Illuminate\Http\Request;

class SAWController extends Controller
{
	protected ZakatService $zakatService;
	protected SAWService $SAWService;
	protected BobotConvertHelper $bobotConvertHelper;

	public function __construct(SAWService $SAWService, ZakatService $zakatService)
	{
		$this->zakatService = $zakatService;
		$this->SAWService = $SAWService;
		$this->bobotConvertHelper = new BobotConvertHelper();
	}

	public function index(Request $request)
	{
		if (!$request->session()->has('sawStep')) {
			$request->session()->put('sawStep', 1);
		}

		$sawStep = $request->session()->get('sawStep');

		if (!$request->session()->has('alternativeSawSPK')) {
			$alternativeSPK = $this->zakatService->getAlternative();
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
			$alternativeSPK = $request->session()->get('alternativeSawSPK');
			$alternativeSPKConvert = $request->session()->get('alternativeSPKConvert');
			$minMax = $request->session()->get('minMax');
			$normalized = $request->session()->get('normalized');
			$weighted = $request->session()->get('weighted');
			$sawRank = $request->session()->get('sawRank');
		}

		return view('pages.zakat.SAW.index', [
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
