<?php

namespace App\Services;


use App\Models\ArsipSuratModel;
use App\Models\CitizensModel;
use App\Models\TemplateSuratModel;
use Dompdf\Dompdf;
use IntlDateFormatter;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;

class LetterService
{
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
			'rt' => $RT,
			'rt_rom' => $this->numberToRomans($RT),
			'keperluan' => explode(';', $data['data_surat'])[0],
			'tanggal_pengajuan' => $this->formatDate(new \DateTime()),
			'tahun' => date('Y'),
			'no_registrasi' => 'SK000012121'
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