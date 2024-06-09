<?php

namespace App\Http\Controllers;

use App\Models\RTModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RTController extends Controller
{
	public function updateKetuaRT(Request $request)
	{
		$roleRT = Auth::user()->role;
		$no_rt = str_split($roleRT, 2)[1];

		$request->validate([
			'new_ketuaRT' => 'required',
		]);

		$rt = RTModel::findOrFail($no_rt);
		$rt->ketua_rt = $request->new_ketuaRT;
		$rt->save();

		return back()->with('toast_success', 'Ketua RT Berhasil Diubah');
	}
}
