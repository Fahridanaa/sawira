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
    <div class="row fill-remaining-space">
        <div class="col">
            <div class="card card-chart">
                <div class="card-header card-header-success">
                    <h4 class="card-title">Jumlah Penduduk yang masuk</h4>
                    <p class="card-category">2024</p>
                </div>
                <div class="card-body">
                    <div class="ct-chart"
                         id="dailySalesChart">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i> updated 4 minutes ago
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
@endpush

