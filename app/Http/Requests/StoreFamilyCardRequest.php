<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFamilyCardRequest extends FormRequest
{
	protected $familyId;

	public function __construct($familyId = null)
	{
		$this->familyId = $familyId;
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
			'id_provinsi' => 'required|string|max:255',
			'id_kabupaten' => 'required|string|max:255',
			'id_kecamatan' => 'required|string|max:255',
			'id_kelurahan' => 'required|string|max:255',
			'no_kk' => [
				'required',
				'string',
				'size:16',
				Rule::unique('kk', 'no_kk')->ignore($this->familyId, 'id_kk')],
			'kode_pos' => 'required|numeric',
			'alamat' => 'required|string|max:255',
		];
	}
}
