<?php

namespace App\Http\Controllers;

use App\Helpers\BobotConvertHelper;
use App\Services\SMARTService;
use App\Services\ZakatService;
use Illuminate\Http\Request;

class SMARTController extends Controller
{
	protected ZakatService $zakatService;
	protected SMARTService $SMARTService;
	protected BobotConvertHelper $bobotConvertHelper;

	public function __construct(SMARTService $SMARTService, ZakatService $zakatService)
	{
		$this->zakatService = $zakatService;
		$this->SMARTService = $SMARTService;
		$this->bobotConvertHelper = new BobotConvertHelper();
	}

	public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
	{
		if (!$request->session()->has('smartStep')) {
			$request->session()->put('smartStep', 1);
		}

		$smartStep = $request->session()->get('smartStep');

		if (!$request->session()->has('alternativeSmartSPK')) {
			$alternativeSPK = $this->zakatService->getAlternative();
			$request->session()->put('alternativeSPK', $alternativeSPK);

			$alternativeSPKConvert = $this->bobotConvertHelper->CriteriaConvert($alternativeSPK);
			$request->session()->put('alternativeSPKConvert', $alternativeSPKConvert);

			$min = $this->SMARTService->min($alternativeSPKConvert);
			$max = $this->SMARTService->max($alternativeSPKConvert);
			$request->session()->put('min', $min);
			$request->session()->put('max', $max);

			$normalized = $this->SMARTService->normalize($alternativeSPKConvert, $min, $max);
			$request->session()->put('normalized', $normalized);

			$weighted = $this->SMARTService->weighted($normalized);
			$request->session()->put('weighted', $weighted);

			$smartRank = $this->SMARTService->smartTotalScore($weighted);
			$request->session()->put('smartRank', $smartRank);
		} else {
			$alternativeSPK = $request->session()->get('alternativeSmartSPK');
			$alternativeSPKConvert = $request->session()->get('alternativeSPKConvert');
			$min = $request->session()->get('min');
			$max = $request->session()->get('max');
			$normalized = $request->session()->get('normalized');
			$weighted = $request->session()->get('weighted');
			$smartRank = $request->session()->get('smartRank');
		}

		return view('pages.zakat.smart.index', [
			'step' => $smartStep,
			'alternativeSPK' => $alternativeSPK,
			'alternativeSPKConvert' => $alternativeSPKConvert,
			'min' => $min,
			'max' => $max,
			'normalized' => $normalized,
			'weighted' => $weighted,
			'smartRank' => $smartRank,
			'smartStep' => $smartStep
		]);
	}

	public function changeStep(Request $request, $step): \Illuminate\Http\RedirectResponse
	{
		// Save the new step in the session
		$request->session()->put('smartStep', $step);

		return redirect()->route('smart');
	}

	public function nextStep(Request $request): \Illuminate\Http\RedirectResponse
	{
		$step = $request->session()->get('smartStep', 1);

		// Increment the step
		$step++;
		if ($step === 8) {
			return redirect()->route('zakat.index');
		}

		// Save the new step in the session
		$request->session()->put('smartStep', $step);

		return redirect()->route('smart');
	}

	public function previousStep(Request $request): \Illuminate\Http\RedirectResponse
	{
		$step = $request->session()->get('smartStep', 1);

		// Decrement the step
		$step--;
		if ($step === 0) {
			return redirect()->route('smart');
		}

		// Save the new step in the session
		$request->session()->put('smartStep', $step);

		return redirect()->route('smart');
	}
}
