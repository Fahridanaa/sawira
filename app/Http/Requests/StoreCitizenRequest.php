<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCitizenRequest extends FormRequest
{
	protected $citizenId;

	public function __construct($citizenId = null)
	{
		$this->citizenId = $citizenId;
	}

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{

		return [
			'id_kk' => 'required|numeric',
			'id_hubungan' => 'required|in:1,2,3',
			'nik' => [
				'required',
				'string',
				'size:16',
				Rule::unique('warga', 'nik')->ignore($this->citizenId, 'id_warga'),
			],
			'nama_lengkap' => 'required|string|max:255',
			'no_telp' => [
				'required',
				'string',
				'min:8',
				'max:15',
				Rule::unique('warga', 'no_telp')->ignore($this->citizenId, 'id_warga'),
			],
			'agama' => 'required|in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Konghucu',
			'status_perkawinan' => 'required|in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati',
			'kewarganegaraan' => 'required|in:WNI,WNA',
			'jenis_kelamin' => 'required|in:L,P',
			'asal_tempat' => 'required|string|max:255',
			'tanggal_lahir' => 'required|date',
			'pendidikan_terakhir' => 'required|string|max:255',
			'pekerjaan' => 'required|string|max:255',
		];
	}
}
