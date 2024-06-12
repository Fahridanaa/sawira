<?php

namespace App\Http\Controllers\views;

use App\Http\Controllers\Controller;
use App\Models\CitizensModel;
use App\Services\ChartService;

class DashboardController extends Controller
{
	public function index(ChartService $chartService)
	{
		$citizens = CitizensModel::all();
		$genderDataStatistics = $chartService->getGenderStatisticsByRT();
		$ageGroupCount = $chartService->categorizeCitizensByAge($citizens);
		$genderManStatistics = $chartService->getGenderManStatisticsByRT($genderDataStatistics);
		$genderWomanStatistics = $chartService->getGenderWomanStatisticsByRT($genderDataStatistics);

		$totalCitizenCount = $chartService->countCitizens();
		$totalFamilyCount = $chartService->countKKs();
		$totalRTCount = $chartService->countRTs();

		$breadcrumbTitle = 'Dashboard';
		$indonesianMonthNames = $chartService->getIndonesianMonths();

		return view('pages.dashboard.index', [
			'breadcrumbTitle' => $breadcrumbTitle,
			'monthLabels' => $indonesianMonthNames,
			'totalCitizenCount' => $totalCitizenCount,
			'totalFamilyCount' => $totalFamilyCount,
			'totalRTCount' => $totalRTCount,
			'ageGroupCounts' => array_values($ageGroupCount),
			'genderManStatistics' => $genderManStatistics,
			'genderWomanStatistics' => $genderWomanStatistics,
		]);
	}
}
