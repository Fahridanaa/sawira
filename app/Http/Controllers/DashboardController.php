<?php

namespace App\Http\Controllers;

use App\Models\SemuaWargaModel;
use App\Models\KKModel;
use App\Models\RTModel;
use App\Models\RiwayatPendudukModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
	public function index()
	{
		$wargas = SemuaWargaModel::all();
        $wargaKeluar = RiwayatPendudukModel::all();
        $data = [];
        $labels = [];
        $data1 = [];
        $usiaPenduduk = [
            'Balita' => 0,
            'Anak-anak' => 0,
            'Remaja' => 0,
            'Dewasa' => 0,
            'Lansia' => 0
        ];

    // Memproses data warga masuk
        foreach ($wargas as $warga) {
            $tanggalMasuk = Carbon::parse($warga->tanggal_masuk);
            $bulan = $tanggalMasuk->format('F');

            if (isset($data[$bulan])) {
                $data[$bulan]++;
            } else {
                $data[$bulan] = 1;
            }
        }

        // Mengurutkan label bulan secara urut dari Januari-Desember
        $bulanIndonesia = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $labels = $bulanIndonesia;

        // Mengurutkan data warga masuk berdasarkan label bulan
        $dataUrut = [];
        foreach ($labels as $bulan) {
            if (isset($data[$bulan])) {
                $dataUrut[$bulan] = $data[$bulan];
            } else {
                $dataUrut[$bulan] = 0;
            }
        }
        $values = array_values($dataUrut);

        // Memproses data warga keluar
        foreach ($wargaKeluar as $warga) {
            $tanggalKeluar = Carbon::parse($warga->tanggal_keluar);
            $bulan = $tanggalKeluar->format('F');

            if (isset($data1[$bulan])) {
                $data1[$bulan]++;
            } else {
                $data1[$bulan] = 1;
            }
        }

        // Mengurutkan data warga keluar berdasarkan label bulan
        $data1Urut = [];
        foreach ($labels as $bulan) {
            if (isset($data1[$bulan])) {
                $data1Urut[$bulan] = $data1[$bulan];
            } else {
                $data1Urut[$bulan] = 0;
            }
        }
        $values1 = array_values($data1Urut);

        foreach($wargas as $warga) {
            $umur = Carbon::parse($warga->tanggal_lahir)->diffInYears(Carbon::now());

            if ($umur <= 5) {
                $usiaPenduduk['Balita']++;
            } elseif ($umur <= 10) {
                $usiaPenduduk['Anak-anak']++;
            } elseif ($umur <= 25) {
                $usiaPenduduk['Remaja']++;
            } elseif ($umur <= 45) {
                $usiaPenduduk['Dewasa']++;
            } else {
                $usiaPenduduk['Lansia']++;
            }
        }
		
		$jumlahWarga = SemuaWargaModel::count('id_warga');
		$jumlahKK = KKModel::count('id_kk');
		$jumlahRiwayatPenduduk = RiwayatPendudukModel::count('id_riwayatPenduduk');
		$jumlahRT = RTModel::count('id_rt');
        $usiaPendudukArray = array_values($usiaPenduduk);
		$breadcrumb = 'Dashboard';
		$level = 'RT';
		return view('dashboard.' . $level, ['breadcrumb' => $breadcrumb, 'labels' => $labels, 'values' => $values, 'chartId' => 'chartId', 'values1' => $values1], compact('jumlahWarga', 'jumlahKK', 'jumlahRT', 'usiaPendudukArray'));
	}

	// $data = SemuaWargaModel::select(DB::raw("COUNT(id_warga) as id_warga"))
	// ->groupBy(DB::raw("Month(tanggal_masuk)"))
	// ->pluck('id_warga');

	// $values = SemuaWargaModel::select(DB::raw("MONTHNAME(tanggal_masuk) as bulan"))
	// ->groupBy(DB::raw("MONTHNAME(tanggal_masuk)"))
	// ->pluck('bulan');
	
	// public function grafik() {
		
	// 	$breadcrumb = 'Dashboard';
	// 	return view('components.charts.penduduk-line-chart', ['breadcrumb' => $breadcrumb] , compact('pendudukMasuk', 'bulan'));
	// }
	// $jumlahWargaPerBulan = SemuaWargaModel::select(
	//     DB::raw('MONTHNAME(tanggal_masuk) as bulan'),
	//     DB::raw('COUNT(id_warga) as total_warga')
	// )
	//     ->groupBy(DB::raw('MONTH(tanggal_masuk)'))
	//     ->get();

	// $labels = $jumlahWargaPerBulan->pluck('bulan')->toArray();
	// $data = $jumlahWargaPerBulan->pluck('total_warga')->toArray();
}
