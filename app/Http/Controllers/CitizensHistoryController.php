<?php

namespace App\Http\Controllers;

use App\DataTables\CitizensHistoryDataTable;
use App\Models\RiwayatWargaModel;
use Illuminate\Http\Request;

class CitizensHistoryController extends Controller
{
    public function index(CitizensHistoryDataTable $citizensHistoryDataTable, Request $request)
	{
		if ($request->has('id_rt')) {
			$id_rt = $request->input('id_rt');
			$citizensHistory = RiwayatWargaModel::whereHas('warga.kk', function ($query) use ($id_rt) {
				$query->where('id_rt', $id_rt);
			})->get();
	
			return $citizensHistoryDataTable->render('components.tables.citizens-history', compact('citizensHistory'));
		}
		return $citizensHistoryDataTable->render('components.tables.citizens-history');
	}
}
