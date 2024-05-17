<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="#">Sawira</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">Sw</a>
    </div>
    <ul class="sidebar-menu">
        <li class="@if(url()->current() === route('dashboard')) active @endif">
            <a class="nav-link"
               href="{{ route('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
        </li>
        <li class="@if(Str::startsWith(Route::currentRouteName(), 'penduduk')) active @endif">
            <a class="nav-link"
               href="/penduduk"><i class="fas fa-columns"></i> <span>Kelola Penduduk</span></a>
        </li>
        <li class="@if(url()->current() === route('history')) active @endif">
            <a class="nav-link"
               href="{{ route('history') }}"><i class="fas fa-history"></i> <span>Riwayat Penduduk</span></a>
        </li>
    </ul>
</aside>
