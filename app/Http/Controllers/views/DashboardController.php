<?php

namespace App\Http\Controllers\views;

use App\Http\Controllers\Controller;
use App\Models\CitizensModel;
use App\Models\KKModel;
use App\Models\RiwayatKKModel;
use App\Models\RiwayatWargaModel;
use App\Services\ChartService;

class DashboardController extends Controller
{
	public function index(ChartService $chartService)
	{
		$citizens = CitizensModel::all();
		// $KK = KKModel::all();
		// $citizensHistory = RiwayatWargaModel::all();
		// $movingCitizensHistory = RiwayatKKModel::all();

		// $citizensByEntryMonth = $chartService->countCitizensByEntryDate($KK);
		// $citizensByExitMonth = $chartService->countCitizensByExitDate($citizensHistory, $movingCitizensHistory);
		$ageGroupCount = $chartService->categorizeCitizensByAge($citizens);
		$labelss = $chartService->getRTLabels();
		$genderManStatistics = $chartService->getGenderManStatisticsByRT();
		$genderWomanStatistics = $chartService->getGenderWomanStatisticsByRT();

		$totalCitizenCount = $chartService->countCitizens();
		$totalFamilyCount = $chartService->countKKs();
		$totalRTCount = $chartService->countRTs();

		$breadcrumbTitle = 'Dashboard';
		$userLevel = 'RT';
		$indonesianMonthNames = $chartService->getIndonesianMonths();

		return view('pages.dashboard.' . $userLevel, [
			'breadcrumbTitle' => $breadcrumbTitle,
			'monthLabels' => $indonesianMonthNames,
			'totalCitizenCount' => $totalCitizenCount,
			'totalFamilyCount' => $totalFamilyCount,
			'totalRTCount' => $totalRTCount,
			'ageGroupCounts' => array_values($ageGroupCount),
			'genderManStatistics' => $genderManStatistics,
			'genderWomanStatistics' => $genderWomanStatistics,
			'labelss' => $labelss,
		]);
	}
}
