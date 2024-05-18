<?php

namespace App\Http\Controllers;

use App\Models\CitizensModel;
use App\Models\KKModel;
use App\Models\RTModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ChartController extends Controller
{
	const AGE_CATEGORIES = [
		'Balita' => 5,
		'Anak-anak' => 10,
		'Remaja' => 25,
		'Dewasa' => 45,
		'Lansia' => PHP_INT_MAX
	];

	public function countCitizensByEntryDate($citizens)
	{
		return $this->countCitizensByDate($citizens, 'tanggal_masuk');
	}

	public function countCitizensByExitDate($citizensHistory)
	{
		return $this->countCitizensByDate($citizensHistory, 'tanggal_keluar');
	}

	public function categorizeCitizensByAge($citizens)
	{
		$citizensCountByAgeCategory = array_fill_keys(array_keys(self::AGE_CATEGORIES), 0);

		foreach ($citizens as $citizen) {
			$age = $this->getAge($citizen->tanggal_lahir);

			foreach (self::AGE_CATEGORIES as $category => $maxAge) {
				if ($age <= $maxAge) {
					$citizensCountByAgeCategory[$category]++;
					break;
				}
			}
		}

		return $citizensCountByAgeCategory;
	}

	public function getIndonesianMonths()
	{
		return [
			'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
			'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
		];
	}

	public function sortDataByMonth($data, $labels)
	{
		$sortedData = [];

		foreach ($labels as $month) {
			$sortedData[$month] = $data[$month] ?? 0;
		}

		return array_values($sortedData);
	}

	public function countCitizens()
	{
		return $this->getCountFromModel(new CitizensModel(), 'id_warga');
	}

	public function countKKs()
	{
		return $this->getCountFromModel(new KKModel(), 'id_kk');
	}

	public function countRTs()
	{
		return $this->getCountFromModel(new RTModel(), 'id_rt');
	}

	private function getCountFromModel(Model $model, string $field): int
	{
		return $model->count($field);
	}

	private function countCitizensByDate($citizens, $dateField)
	{
		$citizensCountByMonth = [];

		foreach ($citizens as $citizen) {
			$month = Carbon::parse($citizen->$dateField)->format('F');
			array_key_exists($month, $citizensCountByMonth)
				? $citizensCountByMonth[$month]++
				: $citizensCountByMonth[$month] = 1;
		}

		return $citizensCountByMonth;
	}

	private function getAge($birthdate)
	{
		return Carbon::parse($birthdate)->diffInYears(Carbon::now());
	}
}
