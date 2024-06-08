<div class="col-lg-8 col-md-12 col-12 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">{{ $cardTitle }}</h4>
      </div>
      <div class="card-body"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
        <canvas id="myChart2" style="display: block; height: 262px; width: 524px;" width="655" height="327" class="chartjs-render-monitor"></canvas>
      </div>
    </div>
</div>
@push('js')
    <script type="module">
        var ctx = document.getElementById("myChart2").getContext('2d');
        const genderManStatistics = @json($genderManStatistics);
        const genderWomanStatistics = @json($genderWomanStatistics);

        var labelss = @json($labelss);
    var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labelss,

        datasets: [{
                label: 'Pria',
                data: Object.values(genderManStatistics),
                borderWidth: 2,
                backgroundColor: "rgba(63,82,227,.8)",
                borderColor: "rgba(63,82,227,.8)",
                pointRadius: 4,
                pointBackgroundColor: "transparent",
            },
            {
                label: 'Wanita',
                data:  Object.values(genderWomanStatistics),
                borderWidth: 2,
                backgroundColor: "rgba(254,86,83,.7)",
                borderColor: "rgba(254,86,83,.7)",
                pointRadius: 4,
                pointBackgroundColor: "transparent",
            },
        ]
    },
    options: {
        // plugins: {
        //     title: {
        //         display: true,
        //         font: {
        //             size: 14
        //         }
        //     },
        // },
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
