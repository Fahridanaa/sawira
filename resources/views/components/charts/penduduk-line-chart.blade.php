<div class="col-lg-8 col-md-12 col-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $cardTitle }}</h4>
        </div>
        <div class="card-body">
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
                type: 'line',
                data: {
                    labels: @json($labels),
                    // ['january', 'february', 'march', 'april', 'mei', 'june', 'july', 'august', 'september', 'october', 'descember']
                    datasets: [
                        {
                            label: 'Penduduk Masuk',
                            data: @json($values),
                            // [9, 3, 7, 5, 3, 5, 0, 2, 9, 6, 15, 10]
                            backgroundColor: 'green',
                            borderColor: 'green',
                            borderWidth: 2,
                            pointBorderColor: 'green',
                            pointRadius: 5
                        },
                        {
                            label: 'Penduduk Keluar',
                            data: @json($valuess),
                            // [2, 5, 10, 8, 7, 3, 1, 4, 6, 9, 10, 12]
                            backgroundColor: 'red',
                            borderColor: 'red',
                            borderWidth: 2,
                            pointBorderColor: 'red',
                            pointRadius: 5
                        }
                    ]
                },
                // clip: {left: 5, top: false, right: -2, bottom: 0},
                options: {
                    responsive: true,
                    scales: {
                        y: {beginAtZero: true},
                    },
                    legend: {
                        display: true,
                        labels: {
                            fontColor: 'black'
                        }
                    },
                }
            });
        });
    </script>
@endpush