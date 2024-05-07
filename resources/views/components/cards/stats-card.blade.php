@props(['color' => 'info', 'icon' => '', 'iconType' => 'material', 'category' => '', 'title' => '', 'footerLink' => '/dashboard' ,'footerText' => ''])
<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="card card-stats">
        <div class="card-header card-header-{{$color}} card-header-icon">
            <div class="card-icon">
                @if ($iconType == 'fa')
                    <i class="fa {{ $icon }}"></i>
                @else
                    <i class="material-icons">{{ $icon }}</i>
                @endif
            </div>
            <p class="card-category">{{ $category }}</p>
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <div class="card-footer">
            <div class="stats">
                <a class="text-decoration-none text-black"
                   href={{ $footerLink }}>{{ $footerText }}</a>
            </div>
        </div>
    </div>
</div>