<?php

namespace App\Services;


use App\Models\ArsipSuratModel;
use App\Models\CitizensModel;
use App\Models\RTModel;
use App\Models\TemplateSuratModel;
use IntlDateFormatter;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\TemplateProcessor;

class LetterService
{
	protected ArsipSuratModel $letter;
	protected TemplateSuratModel $letterTemplate;
	protected CitizensModel $citizens;
	function __construct()
	{
		$this->letter = new ArsipSuratModel();
		$this->letterTemplate = new TemplateSuratModel();
		$this->citizens = new CitizensModel();
	}

	private function searchDocx($id_template_surat)
	{
		$template = $this->searchTemplateLetter($id_template_surat);
		return 'templateSurat/' . $this->StringKebabCase($template) . '.docx';
	}

	private function StringKebabCase($string): string
	{
		return str_replace(' ', '-', strtolower($string));
	}

	private function searchTemplateLetter($id_template_surat)
	{
		return $this->letterTemplate->where('id_template_surat', $id_template_surat)->first()->nama_surat;
	}

	private function searchCitizenById($id_warga)
	{
		return $this->citizens->where('id_warga', $id_warga)->first();
	}

	private function searchRTbyCitizen($id_warga)
	{
		return $this->citizens->whereHas('kk', function ($query) use ($id_warga) {
			$query->where('id_warga', $id_warga);
		})->first()->kk->id_rt;
	}

	private function searchAlamatByCitizen($id_warga)
	{
		return $this->citizens->where('id_warga', $id_warga)->first()->kk->alamat;
	}

	private function numberToRomans($number)
	{
		$map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
		$return = '';
		while ($number > 0) {
			foreach ($map as $roman => $int) {
				if ($number >= $int) {
					$number -= $int;
					$return .= $roman;
					break;
				}
			}
		}
		return $return;
	}

	private function formatDate($date)
	{
		$formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
		$formatter->setPattern('d MMMM Y');
		return $formatter->format($date);
	}

	private function formatRupiah($number)
	{
		return 'Rp' . number_format($number, 0, ',', '.');
	}

	private function gajiConvert($number)
	{
		$words = "";
		$dictionary = array(
			0 => 'nol',
			1 => 'satu',
			2 => 'dua',
			3 => 'tiga',
			4 => 'empat',
			5 => 'lima',
			6 => 'enam',
			7 => 'tujuh',
			8 => 'delapan',
			9 => 'sembilan',
			10 => 'sepuluh',
			11 => 'sebelas',
			100 => 'ratus',
			1000 => 'ribu',
			1000000 => 'juta'
		);

		if ($number < 12) {
			$words .= $dictionary[$number];
		} elseif ($number < 20) {
			$words .= $this->gajiConvert($number - 10) . ' belas';
		} elseif ($number < 100) {
			$words .= $this->gajiConvert(intval($number / 10)) . ' puluh';
			if ($number % 10 != 0) {
				$words .= ' ' . $this->gajiConvert($number % 10);
			}
		} elseif ($number < 1000) {
			$words .= $this->gajiConvert(intval($number / 100)) . ' ratus';
			if ($number % 100 != 0) {
				$words .= ' ' . $this->gajiConvert($number % 100);
			}
		} elseif ($number < 1000000) {
			$words .= $this->gajiConvert(intval($number / 1000)) . ' ribu';
			if ($number % 1000 != 0) {
				$words .= ' ' . $this->gajiConvert($number % 1000);
			}
		} else {
			$words .= $this->gajiConvert(intval($number / 1000000)) . ' juta';
			if ($number % 1000000 != 0) {
				$words .= ' ' . $this->gajiConvert($number % 1000000);
			}
		}

		return strtoupper($words);
	}

	private function extendsGender($gender)
	{
		return $gender == 'L' ? 'Laki-laki' : 'Perempuan';
	}

	/**
	 * @throws CopyFileException
	 * @throws CreateTemporaryFileException
	 */
	private function SuratKeteranganTidakMampu($data)
	{
		$templateProcessor = new TemplateProcessor($this->searchDocx($data['id_template_surat']));
		$citizen = $this->searchCitizenById($data['id_warga']);
		$RT = $this->searchRTbyCitizen($data['id_warga']);

		$templateProcessor->setValues([
			'nama' => $citizen->nama_lengkap,
			'ttl' => $citizen->asal_tempat . ', ' . $this->formatDate($citizen->tanggal_lahir),
			'jenis_kelamin' => $this->extendsGender($citizen->jenis_kelamin),
			'no_ktp' => $citizen->nik,
			'agama' => $citizen->agama,
			'alamat' => $this->searchAlamatByCitizen($data['id_warga']),
			'pekerjaan' => $citizen->pekerjaan,
			'rt' => $RT,
			'rt_rom' => $this->numberToRomans($RT),
			'gaji' => $this->formatRupiah(explode(';', $data['data_surat'])[0]),
			'keperluan' => explode(';', $data['data_surat'])[1],
			'tanggal_pengajuan' => $this->formatDate(new \DateTime()),
			'tahun' => date('Y'),
		]);

		return $templateProcessor;
	}

	private function SuratPengantar($data)
	{
		$templateProcessor = new TemplateProcessor($this->searchDocx($data['id_template_surat']));
		$citizen = $this->searchCitizenById($data['id_warga']);
		$RT = $this->searchRTbyCitizen($data['id_warga']);

		$templateProcessor->setValues([
			'nama' => $citizen->nama_lengkap,
			'ttl' => $citizen->asal_tempat . ', ' . $this->formatDate($citizen->tanggal_lahir),
			'jenis_kelamin' => $this->extendsGender($citizen->jenis_kelamin),
			'alamat' => $this->searchAlamatByCitizen($data['id_warga']),
			'agama' => $citizen->agama,
			'status_perkawinan' => $citizen->status_perkawinan,
			'pekerjaan' => $citizen->pekerjaan,
			'pendidikan_terakhir' => $citizen->pendidikan_terakhir,
			'kewarganegaraan' => $citizen->kewarganegaraan,
			'keperluan' => explode(';', $data['data_surat'])[0],
			'keterangan_lain' => explode(';', $data['data_surat'])[1],
			'nik' => $citizen->nik,
			'rt' => $RT,
			'rt_rom' => $this->numberToRomans($RT),
			'tanggal_pengajuan' => $this->formatDate(new \DateTime()),
			'tahun' => date('Y'),
		]);

		return $templateProcessor;
	}

	private function SuratPernyataan($data)
	{
		$templateProcessor = new TemplateProcessor($this->searchDocx($data['id_template_surat']));
		$citizen = $this->searchCitizenById($data['id_warga']);
		$RT = $this->searchRTbyCitizen($data['id_warga']);
		$ketua_rt = RTModel::findOrFail($RT)->ketua_rt;

		$templateProcessor->setValues([
			'nama' => $citizen->nama_lengkap,
			'nama_kapital' => strtoupper($citizen->nama_lengkap),
			'ttl' => $citizen->asal_tempat . ', ' . $this->formatDate($citizen->tanggal_lahir),
			'alamat' => $this->searchAlamatByCitizen($data['id_warga']),
			'jenis_kelamin' => $this->extendsGender($citizen->jenis_kelamin),
			'nik' => $citizen->nik,
			'pekerjaan' => $citizen->pekerjaan,
			'gaji' => $this->formatRupiah(explode(';', $data['data_surat'])[0]),
			'gaji_convert' => strtoupper($this->gajiConvert(explode(';', $data['data_surat'])[0])) . ' RUPIAH',
			'keperluan' => explode(';', $data['data_surat'])[1],
			'rt_rom' => $this->numberToRomans($RT),
			'ketua_rt' => $ketua_rt ?? "FAZA",
			'tanggal_pengajuan' => $this->formatDate(new \DateTime()),
		]);

		return $templateProcessor;

	}

	public function semicolonArrayString($input)
	{
		if (is_string($input)) {
			return $input . ';';
		}

		$semicolonString = '';
		foreach ($input as $value) {
			$semicolonString .= $value . ';';
		}
		return $semicolonString;
	}

	public function downloadLetter($data)
	{
		$templateName = $this->searchTemplateLetter($data['id_template_surat']);
		$templateFunction = str_replace(' ', '', $templateName);
		$templateProcessor = $this->$templateFunction($data);

		if ($templateProcessor !== null) {
			// Save the TemplateProcessor instance to a temporary file
			$tempFile = tempnam(sys_get_temp_dir(), 'PhpWord') . '.docx';
			$templateProcessor->saveAs($tempFile);

			// Return a response with the Word file
			return response()->download($tempFile, 'surat.docx', [
				'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			]);
		} else {
			throw new Exception('Template not found');
		}
	}
}