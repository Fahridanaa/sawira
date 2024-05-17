<?php

namespace App\Http\Controllers;

use App\Models\CitizensModel;
use App\Models\RiwayatPendudukModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function index()
	{
		$citizens = CitizensModel::all();
		$citizensHistory = RiwayatPendudukModel::all();
		$chartController = new ChartController();

		$citizensByEntryMonth = $chartController->countCitizensByEntryDate($citizens);
		$citizensByExitMonth = $chartController->countCitizensByExitDate($citizensHistory);
		$ageGroupCount = $chartController->categorizeCitizensByAge($citizens);

		$totalCitizenCount = $chartController->countCitizens();
		$totalFamilyCount = $chartController->countKKs();
		$totalRTCount = $chartController->countRTs();

		$breadcrumbTitle = 'Dashboard';
		$userLevel = 'RT';
		$indonesianMonthNames = $chartController->getIndonesianMonths();

		return view('pages.dashboard.' . $userLevel, [
			'breadcrumbTitle' => $breadcrumbTitle,
			'monthLabels' => $indonesianMonthNames,
			'entryDataPerMonth' => $chartController->sortDataByMonth($citizensByEntryMonth, $indonesianMonthNames),
			'exitDataPerMonth' => $chartController->sortDataByMonth($citizensByExitMonth, $indonesianMonthNames),
			'totalCitizenCount' => $totalCitizenCount,
			'totalFamilyCount' => $totalFamilyCount,
			'totalRTCount' => $totalRTCount,
			'ageGroupCounts' => array_values($ageGroupCount),
		]);
	}
}
