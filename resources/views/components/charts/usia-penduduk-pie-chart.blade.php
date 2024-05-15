<div class="col-lg-4">
    <div class="card card-chart">
        <div class="card-header card-header-success">
            <span class="card-title">{{ $cardTitle }}</span>
        </div>
        <div class="card-body d-flex justify-content-center"
             style="max-width: 500px; max-height: 500px;">
            <canvas id="{{ $chartId }}"
                    class="flex-grow-1"></canvas>
        </div>
    </div>
</div>
@push('js')
    <script type="module">
        $(document).ready(function () {
            const ctx = document.getElementById('{{ $chartId }}').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [
                        'Balita', // 5< tahun
                        'Anak-anak', // 6 - 10 tahun 
                        'Remaja', // 10 - 25 tahun
                        'Dewasa', // 26 - 45 tahun
                        'Lansia' // >45 tahun
                    ],
                    datasets: [{
                        // label: 'Usia Penduduk'
                        data: {{ json_encode($data) }},
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(153, 102, 255)'
                        ],
                        hoverOffset: 4
                    }]
                },
                // clip: {left: 5, top: false, right: -2, bottom: 0},
                options: {
                    responsive: true,
                    plugins: {
                        datalabels: {
                            formatter: (value, context) => {
                                let sum = 0;
                                let dataArr = context.chart.data.datasets[0].data;
                                dataArr.map(data => {
                                    sum += data;
                                });
                                let percentage = (value * 100 / sum).toFixed(2) + "%";
                                return percentage;
                            },
                            color: '#fff',
                        }
                        //     tooltip: {
                        //         callbacks: {
                        //             title: function (context) {
                        //                 return 'Custom Title';
                        //             },
                        //             label: function (context) {
                        //                 var label = context.label;
                        //                 var value = context.parsed;
                        //                 return label + ': ' + value;
                        //             }
                        //         }
                        //     }
                    }
                }
            });
        });
    </script>
@endpush