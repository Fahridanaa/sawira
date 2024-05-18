<?php

namespace App\Http\Controllers;

use App\DataTables\CitizensHistoryDataTable;
use Illuminate\Http\Request;
use App\Models\RiwayatWargaModel;

class HistoryCitizensController extends Controller
{
	public function index(CitizensHistoryDataTable $dataTable)
	{
		return $dataTable->render('pages.history.citizens.RT');
	}
}
