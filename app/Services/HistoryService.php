<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class HistoryService
{
	public function uploadFile($data, $request)
	{
		if ($data->file_surat) {
			Storage::delete('public/surat/' . $data->file_surat);
		}

		if ($request->hasFile('file_surat')) {
			$file = $request->file('file_surat');
			$filename = time() . '_' . $file->getClientOriginalName();
			$file->storeAs('public/surat', $filename);

			$data->file_surat = $filename;
			$data->save();
		}
	}

	public function downloadFile($history)
	{
		if ($history->file_surat) {
			return Storage::download('public/surat/' . $history->file_surat);
		}
		return null;
	}
}