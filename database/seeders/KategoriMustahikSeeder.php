<?php

namespace Database\Seeders;

use App\Models\KategoriMustahikModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriMustahikSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$kategoriList = ['Fakir', 'Miskin', 'Riqab', 'Gharim', 'Mualaf', 'Fisabilillah', 'Ibnu Sabil', 'Amil Zakat'];

		foreach ($kategoriList as $kategori) {
			KategoriMustahikModel::create(['nama_kategori' => $kategori]);
		}
	}
}
