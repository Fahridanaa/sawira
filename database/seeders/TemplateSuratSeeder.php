<?php

namespace Database\Seeders;

use App\Models\TemplateSuratModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSuratSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		TemplateSuratModel::create([
			'no_registrasi' => '001',
			'nama_surat' => 'Surat Keterangan Tidak Mampu',
		]);
	}
}
