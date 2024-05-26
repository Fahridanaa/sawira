<?php

namespace App\Http\Controllers;

use App\Models\CitizensModel;
use App\Models\KKModel;
use App\Models\RiwayatPindahModel;
use App\Models\RiwayatWargaModel;
use App\Services\ChartService;

class DashboardController extends Controller
{
	public function index(ChartService $chartService)
	{
		$KK = KKModel::all();
		$citizens = CitizensModel::all();
		$citizensHistory = RiwayatWargaModel::all();
		$movingCitizensHistory = RiwayatPindahModel::all();

		$citizensByEntryMonth = $chartService->countCitizensByEntryDate($KK);
		$citizensByExitMonth = $chartService->countCitizensByExitDate($citizensHistory, $movingCitizensHistory);
		$ageGroupCount = $chartService->categorizeCitizensByAge($citizens);

		$totalCitizenCount = $chartService->countCitizens();
		$totalFamilyCount = $chartService->countKKs();
		$totalRTCount = $chartService->countRTs();

		$breadcrumbTitle = 'Dashboard';
		$userLevel = 'RT';
		$indonesianMonthNames = $chartService->getIndonesianMonths();

		return view('pages.dashboard.' . $userLevel, [
			'breadcrumbTitle' => $breadcrumbTitle,
			'monthLabels' => $indonesianMonthNames,
			'entryDataPerMonth' => $chartService->sortDataByMonth($citizensByEntryMonth, $indonesianMonthNames),
			'exitDataPerMonth' => $chartService->sortDataByMonth($citizensByExitMonth, $indonesianMonthNames),
			'totalCitizenCount' => $totalCitizenCount,
			'totalFamilyCount' => $totalFamilyCount,
			'totalRTCount' => $totalRTCount,
			'ageGroupCounts' => array_values($ageGroupCount),
		]);
	}
}
