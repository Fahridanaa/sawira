@props(['color' => 'info', 'chartId' => '', 'title' => '', 'category' => '', 'statsIcon' => '', 'statsText' => ''])

<div class="col-md">
    <div class="card card-chart">
        <div class="card-header card-header-{{ $color }}">
            <div class="ct-chart"
                 id="{{ $chartId }}"></div>
        </div>
        <div class="card-body">
            <h4 class="card-title">{{ $title }}</h4>
            <p class="card-category">{{ $category }}</p>
        </div>
        <div class="card-footer">
            <div class="stats">
                <i class="material-icons">{{ $statsIcon }}</i> {{ $statsText }}
            </div>
        </div>
    </div>
</div>