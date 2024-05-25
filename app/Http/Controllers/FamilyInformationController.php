<?php

namespace App\Http\Controllers;

use App\DataTables\FamilyInformationDataTable;
use App\Models\CitizensModel;
use App\Models\KKModel;
use Illuminate\Http\Request;
use App\Helpers\DateHelper;

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
