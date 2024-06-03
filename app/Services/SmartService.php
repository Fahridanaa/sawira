<?php

namespace App\Services;

class SMARTService
{
	private $weights = [
		0.2,
		0.25,
		0.15,
		0.05,
		0.35
	];

	public function min($data)
	{
		$min = [];
		foreach ($data as $key => $value) {
			foreach ($value as $k => $v) {
				if ($k === "no_kk" || $k === "nama_lengkap" || $k === "id_kondisi_keluarga" || !isset($v)) {
					continue;
				}

				if (!isset($min[$k]) || $v < $min[$k]) {
					$min[$k] = $v;
				}
			}
		}
		return $min;
	}

	public function max($data)
	{
		$max = [];
		foreach ($data as $key => $value) {
			foreach ($value as $k => $v) {
				if ($k === "no_kk" || $k === "nama_lengkap" || $k === "id_kondisi_keluarga" || !isset($v)) {
					continue;
				}

				if (!isset($max[$k]) || $v > $max[$k]) {
					$max[$k] = $v;
				}
			}
		}
		return $max;
	}

	public function normalize($data, $min, $max)
	{
		$result = [];
		foreach ($data as $key => $value) {
			foreach ($value as $k => $v) {
				if ($k === "no_kk" || $k === "nama_lengkap" || $k === "id_kondisi_keluarga" || !isset($v)) {
					$result[$key][$k] = $v;
					continue;
				}
				if ($k === 1 || $k === 3) {
					$result[$key][$k] = round(($max[$k] - $v) / ($max[$k] - $min[$k]), 3);
				} else {
					$result[$key][$k] = round(($v - $min[$k]) / ($max[$k] - $min[$k]), 3);
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
				if ($k === "no_kk" || $k === "nama_lengkap" || $k === "id_kondisi_keluarga") {
					$result[$key][$k] = $v;
					continue;
				}
				$result[$key][$k] = round($v * $this->weights[$k], 3);
			}
		}
		return $result;
	}

	public function smartTotalScore($data)
	{
		$smart = [];
		foreach ($data as $key => $value) {
			foreach ($value as $k => $v) {
				if ($k === "no_kk" || $k === "nama_lengkap" || $k === "id_kondisi_keluarga") {
					$smart[$key][$k] = $v;
				}
			}
			$smart[$key]['sum'] = array_sum($value);
		}

		uasort($smart, function ($a, $b) {
			return $b['sum'] <=> $a['sum'];
		});

		$smart = array_values($smart);

		return $smart;
	}

	public function fullCalculateSmart($data)
	{
		$min = $this->min($data);
		$max = $this->max($data);
		$normalized = $this->normalize($data, $min, $max);
		$weighted = $this->weighted($normalized);
		return $this->smartTotalScore($weighted);
	}
}
