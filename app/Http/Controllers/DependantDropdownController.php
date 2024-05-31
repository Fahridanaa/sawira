<?php

namespace App\Http\Controllers;

use App\Models\CitizensModel;
use App\Models\KKModel;
use Illuminate\Http\Request;

class DependantDropdownController extends Controller
{
	public function provinces()
	{
		return \Indonesia::allProvinces();
	}

	public function cities(Request $request)
	{
		return \Indonesia::findProvince($request->id, ['cities'])->cities->pluck('name', 'id');
	}

	public function districts(Request $request)
	{
		return \Indonesia::findCity($request->id, ['districts'])->districts->pluck('name', 'id');
	}

	public function villages(Request $request)
	{
		return \Indonesia::findDistrict($request->id, ['villages'])->villages->pluck('name', 'id');
	}

	public function citizens(Request $request)
	{
		$id_warga = $request->id;

		$KK = KKModel::select('alamat', 'id_rt')->with('citizens')->whereHas('citizens', function ($query) use ($id_warga) {
			$query->where('id_warga', $id_warga);
		})->get();

		$citizens = CitizensModel::where('id_warga', $request->id)->first();

		$data = array_merge(
			['alamat' => data_get($KK[0], 'alamat')],
			['rt' => data_get($KK[0], 'id_rt')],
			(array)$citizens->toArray());

		return (object)$data;
	}
}
