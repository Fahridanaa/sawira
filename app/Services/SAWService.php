<?php

namespace App\Services;

class SAWService
{
	private $weight = [
		0.2,
		0.25,
		0.15,
		0.05,
		0.35
	];

	public function minMax($data)
	{
		$minMax = [];
		foreach ($data as $key => $value) {
			foreach ($value as $k => $v) {
				if (!isset($v)) {
					continue;
				}

				if ($k === "no_kk" || $k === "nama_lengkap") {
					continue;
				}

				if (!isset($minMax[$k])) {
					$minMax[$k] = $v;
				} else if ($v < $minMax[$k] && ($k == 0 || $k == 2)) {
					$minMax[$k] = $v;
				} else if ($v > $minMax[$k]) {
					$minMax[$k] = $v;
				}
			}
		}
		return $minMax;
	}

	public function normalized($data, $minMax)
	{
		$result = [];
		foreach ($data as $key => $value) {
			foreach ($value as $k => $v) {
				if ($k === "no_kk" || $k === "nama_lengkap") {
					$result[$key][$k] = $v;
					continue;
				}

				if ($k == 0 || $k == 2) {
					$result[$key][$k] = round($minMax[$k] / ($v), 3);
				} else {
					$result[$key][$k] = round($v / $minMax[$k], 3);
				}
			}
		}
		return $result;
	}

	public function weighted($data)
	{
		$result = [];

		foreach ($data as $key => $value) {
			foreach ($value as $k => $v) {
				if ($k === "no_kk" || $k === "nama_lengkap") {
					$result[$key][$k] = $v;
					continue;
				}

				$result[$key][$k] = round($v * $this->weight[$k], 3);
			}
		}
		return $result;
	}

	public function saw($data)
	{
		$saw = [];
		foreach ($data as $key => $value) {
			foreach ($value as $k => $v) {
				if ($k === "no_kk" || $k === "nama_lengkap") {
					$saw[$key][$k] = $v;
				}
			}
			$saw[$key]['sum'] = array_sum($value);
		}
		arsort($saw);
		return $saw;
	}
}