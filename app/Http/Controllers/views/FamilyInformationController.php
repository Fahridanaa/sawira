<?php

namespace App\Http\Controllers\views;

use App\DataTables\FamilyInformationDataTable;
use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Models\KKModel;

class FamilyInformationController extends Controller
{
	public function index(FamilyInformationDataTable $dataTable)
	{
		$id_user = auth()->user()->id_user;
		$id_kk = KKModel::where('id_user', $id_user)->first()->id_kk;
		$no_kk = KKModel::where('id_kk', $id_kk)->first()->no_kk;
		$dataTable->id_kk = $id_kk;
		return $dataTable->render('pages.information.index', ['no_kk' => $no_kk]);
	}
}
