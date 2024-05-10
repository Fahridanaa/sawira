<div class="col-lg-8">
    <div class="card card-chart">
        <div class="card-header card-header-success">
            <span class="card-title">{{ $cardTitle }}</span>
            <p class="card-category">{{ $cardCategory }}</p>
        </div>
        <div class="card-body d-flex">
            <canvas id="{{ $chartId }}"
                    class="flex-grow-1"></canvas>
        </div>
        <div class="card-footer">
            <div class="stats">
                <i class="material-icons">access_time</i> {{ $updatedTime }}
            </div>
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