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
		TemplateSuratModel::insert(
			[
				[
					'nama_surat' => 'Surat Keterangan Tidak Mampu',
				],
				[
					'nama_surat' => 'Surat Pengantar',
				],
				[
					'nama_surat' => 'Surat Pernyataan'
				]
			]
		);
	}
}
