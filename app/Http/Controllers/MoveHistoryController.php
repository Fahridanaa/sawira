<?php

namespace App\Http\Controllers;

use App\DataTables\MoveHistoryDataTable;
use App\Models\RiwayatPindahModel;
use Illuminate\Http\Request;

class MoveHistoryController extends Controller
{
    public function index(MoveHistoryDataTable $moveHistoryDataTable, Request $request)
	{
		if ($request->has('id_rt')) {
			$id_rt = $request->input('id_rt');
			$moveHistory = RiwayatPindahModel::whereHas('KK', function ($query) use ($id_rt) {
				$query->where('id_rt', $id_rt);
			})->get();
	
			return $moveHistoryDataTable->render('components.tables.move-history', compact('moveHistory'));
		}
		return $moveHistoryDataTable->render('components.tables.move-history');
	}
}
