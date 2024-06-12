<?php

namespace App\Http\Controllers\views;

use App\DataTables\FamilyInformationDataTable;
use App\Http\Controllers\Controller;
use App\Models\KKModel;

class FamilyMemberInformationController extends Controller
{
	public function index(FamilyInformationDataTable $dataTable)
	{
		$id_user = auth()->user()->id_user;
		$id_kk = KKModel::where('id_user', $id_user)->first()->id_kk;
		$dataTable->id_kk = $id_kk;
		return $dataTable->render('pages.memberInfo.index');
	}
}
