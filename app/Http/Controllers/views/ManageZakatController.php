<?php

namespace App\Http\Controllers\views;

use App\DataTables\SAWRankingDataTable;
use App\DataTables\SMARTRankingDataTable;
use App\Helpers\BobotConvertHelper;
use App\Http\Controllers\Controller;
use App\Models\KondisiKeluargaModel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\SAWRankModel;
use App\Models\SMARTRankModel;
use App\Services\SAWService;
use App\Services\SMARTService;
use Illuminate\Support\Facades\DB;

class ManageZakatController extends Controller
{
	protected SMARTService $SMARTService;
	protected SAWService $SAWService;
	protected BobotConvertHelper $bobotConvertHelper;

	public function __construct(SAWService $SAWService, SMARTService $SMARTService)
	{
		$this->SMARTService = $SMARTService;
		$this->SAWService = $SAWService;
		$this->bobotConvertHelper = new BobotConvertHelper();
	}

	public function index()
	{
		return view('pages.zakat.index');
	}

	public function exportSAWPdf()
    {
        $sawRanks = SAWRankModel::with(['kondisiKeluarga.kk.citizens'])->get();
        $dompdf = PDF::loadView('pdf.saw-ranking', compact('sawRanks'));
        // $dompdf->loadHtml(view('pdf.saw-ranking', compact('sawRanks'))->render());
        // $dompdf->setPaper('A4', 'landscape');
        // $dompdf->render();
        
        return $dompdf->download('SAWRanking_' . date('YmdHis') . '.pdf');
    }
	public function exportSMARTPdf()
    {
        $smartRanks = SAWRankModel::with(['kondisiKeluarga.kk.citizens'])->get();
        $dompdf = PDF::loadView('pdf.smart-ranking', compact('smartRanks'));
        // $dompdf->loadHtml(view('pdf.saw-ranking', compact('sawRanks'))->render());
        // $dompdf->setPaper('A4', 'landscape');
        // $dompdf->render();
        
        return $dompdf->download('SMARTRanking_' . date('YmdHis') . '.pdf');
    }
	public function store()
	{
		DB::table('saw_rank')->truncate();
		DB::table('smart_rank')->truncate();
		$kkData = KondisiKeluargaModel::with(['kk' => function ($query) {
			$query->select('id_kk', 'no_kk');
		}])->whereNotNull('jumlah_penghasilan')
			->whereNotNull('jumlah_pengeluaran')
			->whereNotNull('jumlah_tanggungan')
			->whereNotNull('jumlah_hutang')
			->whereNotNull('kondisi_tempat_tinggal')
			->get();

		$citizensData = KondisiKeluargaModel::with(['kk.citizens' => function ($query) {
			$query->select('id_kk', 'nama_lengkap')
				->where('id_hubungan', 1);
		}])->whereNotNull('jumlah_penghasilan')
			->whereNotNull('jumlah_pengeluaran')
			->whereNotNull('jumlah_tanggungan')
			->whereNotNull('jumlah_hutang')
			->whereNotNull('kondisi_tempat_tinggal')
			->get();

		$alternativeSPK = $kkData->merge($citizensData)->toArray();
		$alternativeSPKConvert = $this->bobotConvertHelper->CriteriaConvert($alternativeSPK);
		$sawResult = $this->SAWService->fullCalculatedSaw($alternativeSPKConvert);
		$smartResult = $this->SMARTService->fullCalculatedSmart($alternativeSPKConvert);
		DB::transaction(function () use ($sawResult, $smartResult) {
			foreach ($sawResult as $key => $result) {
				SAWRankModel::create([
					'id_kondisi_keluarga' => $result['id_kondisi_keluarga'],
					'nilai_saw' => $result['sum']
				]);
			}

			foreach ($smartResult as $key => $result) {
				SMARTRankModel::create([
					'id_kondisi_keluarga' => $result['id_kondisi_keluarga'],
					'nilai_smart' => $result['sum']
				]);
			}
		}, 3);

		return redirect('zakat.index')->with('toast_success', 'Zakat berhasil dihitung!');
	}

	public function saw(SAWRankingDataTable $SAWRankingDataTable)
	{
		return $SAWRankingDataTable->render('components.tables.saw');
	}

	public function smart(SMARTRankingDataTable $SMARTRankingDataTable)
	{
		return $SMARTRankingDataTable->render('components.tables.smart');
	}
}
