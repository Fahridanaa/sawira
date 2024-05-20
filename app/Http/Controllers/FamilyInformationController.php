<?php

namespace App\Http\Controllers;

use App\DataTables\FamilyInformationDataTable;
use App\Models\KKModel;
use Illuminate\Http\Request;

class FamilyInformationController extends Controller
{
	public function index(FamilyInformationDataTable $dataTable)
	{
		$id_user = auth()->user()->id_user;
		$id_kk = KKModel::where('id_user', $id_user)->first()->id_kk;
		$dataTable->id_kk = $id_kk;
		return $dataTable->render('pages.manageCitizens.show');
	}
}
