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
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [
                        {
                            label: 'Penduduk Masuk',
                            data: [15, 25, 30, 22, 20, 10, 5, 17, 21, 28, 30, 35],
                            backgroundColor: 'green',
                            borderColor: 'green',
                            borderWidth: 2,
                            pointBorderColor: 'green',
                            pointRadius: 5
                        },
                        {
                            label: 'Penduduk Keluar',
                            data: [2, 5, 10, 8, 7, 3, 1, 4, 6, 9, 10, 12],
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