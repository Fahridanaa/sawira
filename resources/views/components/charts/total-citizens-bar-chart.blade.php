<div class="col-lg-8 col-md-12 col-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $cardTitle }}</h4>
        </div>
        <div class="card-body d-flex justify-content-center">
            <div class="chartjs-size-monitor">
                <div class="chartjs-size-monitor-expand">
                </div>
                <div class="chartjs-size-monitor-shrink">
                </div>
            </div>
            <canvas id="myChart2"
                    height="500"
                    class="chartjs-render-monitor">
            </canvas>
        </div>
    </div>
</div>
@push('js')
    <script type="module">
        var ctx = document.getElementById("myChart2").getContext('2d');
        
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                datasets: [
                    {
                        label: 'Pria',
                        data: @json($genderManStatistics),
                        borderWidth: 2,
                        backgroundColor: "rgba(63,82,227,.8)",
                        borderColor: "rgba(63,82,227,.8)",
                        pointRadius: 4,
                        pointBackgroundColor: "transparent",
                    },
                    {
                        label: 'Wanita',
                        data: @json($genderWomanStatistics),
                        borderWidth: 2,
                        backgroundColor: "rgba(254,86,83,.7)",
                        borderColor: "rgba(254,86,83,.7)",
                        pointRadius: 4,
                        pointBackgroundColor: "transparent",
                    },
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true
                    }
                }
            }
        });
    </script>
@endpush
