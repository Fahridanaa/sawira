@extends('layouts.template')
@section('content')
    <div class="row">
        <x-cards.stats-card
                color="success"
                icon="people"
                category="Penduduk"
                title="55555"
                footerText="Kelola Data Penduduk">
        </x-cards.stats-card>
        <x-cards.stats-card
                color="info"
                icon="family_restroom"
                category="Kartu Keluarga"
                title="44444"
                footerText="Kelola Kartu Keluarga">
        </x-cards.stats-card>
        <x-cards.stats-card
                color="warning"
                icon="history"
                category="Riwayat Penduduk"
                title="32"
                footerText="Riwayat Penduduk">
        </x-cards.stats-card>
    </div>
    <div class="row flex-grow-1 mx-xl-5">
        <div class="col flex-grow-1 d-flex flex-column overflow-auto mw-100">
            <div class="card card-chart">
                <div class="card-header card-header-success">
                    <span class="card-title">Jumlah Penduduk yang masuk</span>
                    <span class="card-category">2024</span>
                </div>
                <div class="card-body d-flex flex-column  overflow-auto">
                    <div class="ct-chart flex-grow-1"
                         id="dailySalesChart">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
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
                        high: 40, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                        chartPadding: {
                            top: 25,
                            right: 10,
                            bottom: 25,
                            left: 10
                        },
                        width: '100%',
                        height: '300px'
                    }

                    const dailySalesChart = new Chartist.LineChart('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

                    dailySalesChart.update();
                }
            }

            initDashboardPageCharts();
        });
    </script>
@endpush

