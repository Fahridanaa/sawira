<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="#">Sawira</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">Sw</a>
    </div>
    <ul class="sidebar-menu">
        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
            <a class="nav-link"
               href="{{ route('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
        </li>
        @if(!\App\Helpers\SidebarHelper::hasAnyRole(['warga', 'amil']))
            <li class="{{ Request::is('penduduk') || Request::is('family-heads.create') || Request::is('citizen.create') ? 'active' : '' }}">
                <a class="nav-link"
                   href="/penduduk"><i class="fas fa-columns"></i> <span>Kelola Penduduk</span></a>
            </li>
            <li class="{{ Request::is('history') ? 'active' : '' }}">
                <a class="nav-link"
                   href="{{ route('history') }}"><i class="fas fa-history"></i> <span>Riwayat Penduduk</span></a>
            </li>
            @if(!\App\Helpers\SidebarHelper::hasAnyRole(['warga', 'amil', 'rw']))
                <li>
                    <a class="nav-link"
                       href="{{ route('dashboard') }}"><i class="fas fa-handshake"></i> <span>Pengajuan Mustahik</span></a>
                </li>
            @endif
        @endif
        @if(\App\Helpers\SidebarHelper::hasAnyRole(['warga']))
            <li class="{{ Request::is('family') }}">
                <a class="nav-link"
                   href="/family"><i class="fas fa-columns"></i> <span>Informasi Pribadi</span></a>
            </li>
        @endif
    </ul>
</aside>
