<div class="col-lg-8 col-md-12 col-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $cardTitle }}</h4>
        </div>
        <div class="card-body">
            <div class="chartjs-size-monitor"
                 style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                <div class="chartjs-size-monitor-expand"
                     style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                </div>
                <div class="chartjs-size-monitor-shrink"
                     style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                </div>
            </div>
            <canvas id="{{ $chartId }}"
                    class="chartjs-render-monitor"></canvas>
        </div>
    </div>
</div>

@push('js')
    <script type="module">
        $(document).ready(function () {
            const ctx = document.getElementById('{{ $chartId }}').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [
                        {
                            label: 'Penduduk Masuk',
                            data: @json($entryCitizenData),
                            // data: [1, 2, 3, 2, 1, 2, 3, 4, 5, 4, 3, 2],
                            borderWidth: 2,
                            backgroundColor: "rgba(63,82,227,.8)",
                            borderColor: "rgba(63,82,227,.8)",
                            pointRadius: 4,
                            pointBackgroundColor: "transparent",
                            pointHoverBackgroundColor: "rgba(63,82,227,.8)",
                            fill: 'origin',
                            tension: 0.3,  // Adjust this value to control the curve of the line
                        },
                        {
                            label: 'Penduduk Keluar',
                            data: @json($exitCitizenData),
                            // data: [2, 3, 1, 4, 1, 2, 2, 1, 3, 5, 4, 2],
                            borderWidth: 2,
                            backgroundColor: "rgba(254,86,83,.7)",
                            borderColor: "rgba(254,86,83,.7)",
                            pointRadius: 4,
                            pointBackgroundColor: "transparent",
                            fill: 'origin',
                            tension: 0.3,  // Adjust this value to control the curve of the line
                        }
                    ]
                },
                options: {
                    legend: {
                        display: true,
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 2,
                            },
                            grid: {
                                drawBorder: false,
                                color: "#f2f2f2",
                            },
                        },
                        x: {
                            grid: {
                                display: false,
                                tickMarkLength: 15,
                            },
                        },
                    },
                }
            })
            ;
        });
    </script>
@endpush