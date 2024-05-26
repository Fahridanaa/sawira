<aside id="sidebar-wrapper"
       class="d-flex h-100 flex-column">
    <div class="sidebar-brand">
        <a href="#">Sawira</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">Sw</a>
    </div>
    <ul class="sidebar-menu d-flex flex-column h-100">
        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
            <a class="nav-link"
               href="{{ route('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
        </li>
        @if(!\App\Helpers\SidebarHelper::hasAnyRole(['warga', 'amil']))
            <li class="{{ Request::is('penduduk') || Request::is('tab-content*') ? 'active' : '' }}">
                <a class="nav-link"
                   href="/penduduk"><i class="fas fa-columns"></i> <span>Kelola Penduduk</span></a>
            </li>
            <li class="{{ Request::is('history') ? 'active' : '' }}">
                <a class="nav-link"
                   href="{{ route('history') }}"><i class="fas fa-history"></i> <span>Riwayat Penduduk</span></a>
            </li>
            @if(!\App\Helpers\SidebarHelper::hasAnyRole(['rw']))
                <li class="{{ Request::is('submission*') ? 'active' : '' }}">
                    <a class="nav-link"
                       href="{{ route('submission.create') }}"><i class="fas fa-handshake"></i>
                        <span>Pengajuan Mustahik</span></a>
                </li>
            @endif
        @endif
        @if(\App\Helpers\SidebarHelper::hasAnyRole(['warga']))
            <li class="{{ Request::is('family')  ? 'active' : '' }}">
                <a class="nav-link"
                   href="/family"><i class="fas fa-address-card"></i> <span>Informasi Pribadi</span></a>
            </li>
            <li class="{{ Request::is('mail*') ? 'active' : '' }}">
                <a class="nav-link"
                   href="{{ route('mail.index') }}"><i class="fas fa-mail-bulk"></i> <span>Surat</span></a>
            </li>
        @endif
        @if(\App\Helpers\SidebarHelper::hasAnyRole(['amil']))
            <li class="{{ Request::is('submission*') ? 'active' : '' }}">
                <a class="nav-link"
                   href="{{ route('submission.index') }}"><i class="fas fa-handshake"></i>
                    <span>List Pengajuan</span></a>
            </li>
        @endif
        <div class="flex-grow-1"></div>
        @if(\App\Helpers\SidebarHelper::hasAnyRole(['warga']))
            <li class="{{ Request::is('settings') ? 'active' : '' }}">
                <a class="nav-link"
                   href="{{ route('settings') }}"><i class="fas fa-cog"></i> <span>Pengaturan Akun</span></a>
            </li>
        @endif
        <li class="mb-2">
            <form id="logoutForm"
                  method="POST"
                  action="{{ route('logout') }}">
                @csrf
            </form>
            <a href="{{ route('logout') }}"
               onClick="event.preventDefault(); document.getElementById('logoutForm').submit();"
               class="nav-link text-danger">
                <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
            </a>
        </li>
    </ul>
</aside>
<style>
    .main-sidebar .sidebar-menu li a:hover {
        background-color: #f5f5f5;
    }
</style>
