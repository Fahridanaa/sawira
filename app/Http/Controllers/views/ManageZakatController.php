<?php

namespace App\Http\Controllers\views;

use App\DataTables\SAWRankingDataTable;
use App\Helpers\BobotConvertHelper;
use App\Http\Controllers\Controller;
use App\Models\KondisiKeluargaModel;
use App\Models\SAWRankModel;
use App\Services\SAWService;
use Illuminate\Support\Facades\DB;

class ManageZakatController extends Controller
{
	protected SAWService $SAWService;
	protected BobotConvertHelper $bobotConvertHelper;

	public function __construct(SAWService $SAWService)
	{
		$this->SAWService = $SAWService;
		$this->bobotConvertHelper = new BobotConvertHelper();
	}

	public function index()
	{
		return view('pages.zakat.index');
	}

	public function store()
	{
		DB::table('saw_rank')->truncate();
		$kkData = KondisiKeluargaModel::with(['kk' => function ($query) {
			$query->select('id_kk', 'no_kk');
		}])->get();

		$citizensData = KondisiKeluargaModel::with(['kk.citizens' => function ($query) {
			$query->select('id_kk', 'nama_lengkap')
				->where('id_hubungan', 1);
		}])->get();

		$alternativeSPK = $kkData->merge($citizensData)->toArray();
		$alternativeSPKConvert = $this->bobotConvertHelper->CriteriaConvert($alternativeSPK);
		$sawResult = $this->SAWService->fullCalculatedSaw($alternativeSPKConvert);
		DB::transaction(function () use ($sawResult) {
			foreach ($sawResult as $key => $result) {
				SAWRankModel::create([
					'id_kondisi_keluarga' => $result['id_kondisi_keluarga'],
					'nilai_saw' => $result['sum']
				]);
			}
		}, 3);

		return redirect()->route('zakat.index');
	}

	public function saw(SAWRankingDataTable $SAWRankingDataTable)
	{
		return $SAWRankingDataTable->render('components.tables.saw');
	}

	public function smart()
	{
		// dataTables here
	}
}
