@extends('layouts.template')
@section('content')
    <div class="row">
        <x-cards.stats-card
                color="success"
                icon="people"
                category="Penduduk"
                title="{{ $jumlahWarga }}"
                footerText="Kelola Data Penduduk">
        </x-cards.stats-card>
        <x-cards.stats-card
                color="info"
                icon="family_restroom"
                category="Kartu Keluarga"
                title="{{ $jumlahKK }}"
                footerText="Kelola Kartu Keluarga">
        </x-cards.stats-card>
        <x-cards.stats-card
                color="warning"
                icon="history"
                category="Riwayat Penduduk"
                title="{{ $jumlahRT }}"
                footerText="Riwayat Penduduk">
        </x-cards.stats-card>
    </div>
    <div class="row flex-grow-1 d-flex">
        <x-charts.penduduk-line-chart
                cardTitle="Penduduk Masuk dan Keluar"
                cardCategory="2024"
                chartId="citizensChart"
                :labels="$labels"
                :values="$values"
                :valuess="$values1"
                updatedTime="updated 4 minutes ago">
        </x-charts.penduduk-line-chart>
        <x-charts.usia-penduduk-pie-chart
                cardTitle="Usia Penduduk"
                chartId="ageChart"
                :data="$usiaPendudukArray"
                updatedTime="updated 4 minutes ago">
        </x-charts.usia-penduduk-pie-chart>
    </div>
@endsection
@push('js')
    <<<<<<< HEAD
    <script>
        $(document).ready(function () {
            function initDashboardPageCharts() {
                let dataDailySalesChart;
                let optionsDailySalesChart;
                if ($('#dailySalesChart').length !== 0) {
                    dataDailySalesChart = {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                        series: [
                            [15, 25, 30, 22, 20, 10, 5, 17, 21, 28, 30, 35]
                        ]
                    };

                    optionsDailySalesChart = {
                        lineSmooth: Chartist.Interpolation.cardinal({
                            tension: 0
                        }),
                        low: 0,
                        high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                        chartPadding: {
                            top: 30,
                            right: 15,
                            bottom: 30,
                            left: 15
                        },
                    }

                    const dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

                    md.startAnimationForLineChart(dailySalesChart);
                }
            }

            initDashboardPageCharts();
        });
    </script>
    =======
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    >>>>>>> 8c0f19caace1781512ac79e7f8f1480dc12e3aa4
@endpush

