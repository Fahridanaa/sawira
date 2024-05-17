<?php

namespace App\Http\Controllers;

use App\DataTables\CitizensDataTable;
use App\DataTables\FamilyHeadDataTable;
use Illuminate\Http\Request;

class TabController extends Controller
{
	public function getTabContent(FamilyHeadDataTable $familyHeadDataTable, CitizensDataTable $citizensDataTable, $tabId)
	{
		if ($tabId == 'kk') {
			return $familyHeadDataTable->render('components.tables.kartu-keluarga');
		} elseif ($tabId == 'citizens') {
			return $citizensDataTable->render('components.tables.semua-warga');
		} else {
			return response('Tab not found', 404);
		}
	}
}
