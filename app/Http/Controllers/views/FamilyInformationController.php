<?php

namespace App\Http\Controllers\views;

use App\Http\Controllers\Controller;
use App\Models\CitizensModel;
use App\Models\KKModel;
use App\Models\KondisiKeluargaModel;
use Illuminate\Http\Request;
use App\Helpers\HouseConditionHelper;

class FamilyInformationController extends Controller
{
	public function index()
	{
		$id_user = auth()->user()->id_user;
		$kk = KKModel::where('id_user', $id_user)->first()->toArray();
		$kepalaKeluarga = [
			'kepalaKeluarga' => CitizensModel::where('id_kk', $kk['id_kk'])->where('id_hubungan', '1')->first()->nama_lengkap
		];
		$province = \Indonesia::findProvince($kk['id_provinsi'])->name;
		$kabupaten = \Indonesia::findCity($kk['id_kabupaten'])->name;
		$kecamatan = \Indonesia::findDistrict($kk['id_kecamatan'])->name;
		$kelurahan = \Indonesia::findVillage($kk['id_kelurahan'])->name;
		$alamat = [
			'provinsi' => $province,
			'kabupaten' => $kabupaten,
			'kecamatan' => $kecamatan,
			'kelurahan' => $kelurahan
		];
		$kondisiKeluarga = KondisiKeluargaModel::where('id_kk', $kk['id_kk'])->first()->toArray();

		if ($kondisiKeluarga['kondisi_tempat_tinggal']) {
			$kondisi_tempat = [
				'kondisi_tempat' => HouseConditionHelper::getHouseCondition($kondisiKeluarga['kondisi_tempat_tinggal'])
			];
			$kondisiKeluarga = array_merge($kondisiKeluarga, $kondisi_tempat);
		}

		$familyInformation = array_replace($kk, $kepalaKeluarga, $alamat, $kondisiKeluarga);

		return view('pages.familyInfo.index', ['familyInformation' => $familyInformation]);
	}

	public function update(Request $request)
	{
		$id_user = auth()->user()->id_user;
		$kk = KKModel::where('id_user', $id_user)->first();
		$kondisiKeluarga = KondisiKeluargaModel::where('id_kk', $kk->id_kk)->first();
		$kondisiKeluarga->update($request->all());
		return redirect('informasi-keluarga.index')->with('toast_success', 'Data berhasil diubah!');
	}
}
