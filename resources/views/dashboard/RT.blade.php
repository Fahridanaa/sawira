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
    <div class="row flex-grow-1">
        <div class="col d-flex">
            <div class="card card-chart flex-grow-1">
                <div class="card-header card-header-success">
                    <h4 class="card-title">Jumlah Penduduk yang masuk</h4>
                    <p class="card-category">2024</p>
                </div>
                <div class="card-body d-flex">
                    <div class="ct-chart flex-grow-1"
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
        function startAnimationForLineChart(chart) {
            chart.on('draw', function (data) {
                if (data.type === 'line' || data.type === 'area') {
                    data.element.animate({
                        d: {
                            begin: 600,
                            dur: 700,
                            from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                            to: data.path.clone().stringify(),
                            easing: Chartist.Svg.Easing.easeOutQuint
                        }
                    });
                } else if (data.type === 'point') {
                    seq++;
                    data.element.animate({
                        opacity: {
                            begin: 0,
                            dur: 500,
                            from: 0,
                            to: 1,
                            easing: 'ease'
                        }
                    });
                }
            });

            seq = 0;
        }

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

                    const dailySalesChart = new Chartist.LineChart('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

                    startAnimationForLineChart(dailySalesChart);
                }
            }

            initDashboardPageCharts();
        });
    </script>
@endpush

