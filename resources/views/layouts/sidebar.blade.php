<aside id="sidebar-wrapper"
       class="d-flex h-100 flex-column">
    <div class="sidebar-brand">
        <a href="#">Sawira</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">
            <div class="login-brand">
                <style>.login-brand img {
                        margin-top: -30px;
                    }
                </style>
                <img src="{{ asset('assets/img/logo-01.svg') }}"
                     alt="logo"
                     width="30">
            </div>
        </a>
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
        @endif
        @if(\App\Helpers\SidebarHelper::hasAnyRole(['warga']))
            <li class="{{ Request::is('family*')  ? 'active' : '' }}">
                <a class="nav-link"
                   href="/family"><i class="fas fa-address-card"></i> <span>Informasi Anggota</span></a>
            </li>
            <li class="{{ Request::is('informasi-keluarga*') ? 'active' : '' }}">
                <a href="{{ route('informasi-keluarga.index') }}"
                   class="nav-link"><i class="fas fa-money-bill"></i> <span>Informasi Keluarga</span></a>
            </li>
            <li class="{{ Request::is('letter*') ? 'active' : '' }}">
                <a class="nav-link"
                   href="{{ route('letter.index') }}"><i class="fas fa-mail-bulk"></i> <span>Surat</span></a>
            </li>
        @endif
        @if(\App\Helpers\SidebarHelper::hasAnyRole(['amil']))
            <li class="dropdown {{ Request::is('zakat*') || Request::is('saw') ? 'active' : '' }}">
                <a href="#"
                   class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Pembagian Zakat</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('zakat') ? 'active' : '' }}">
                        <a class="nav-link"
                           href="{{ route('zakat.index') }}">
                            <span>Hasil Perhitungan</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('zakat/saw*') ? 'active' : '' }}">
                        <a class="nav-link"
                           href="{{ route('saw') }}">
                            <span>Perhitungan SAW</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('zakat/smart*') ? 'active' : '' }}">
                        <a class="nav-link"
                           href="{{ route('smart') }}">
                            <span>Perhitungan Smart</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if(\App\Helpers\SidebarHelper::hasAnyRole(['rw']))
            <li class="{{ Request::is('letter-archives')  ? 'active' : '' }}">
                <a class="nav-link"
                   href="{{ route('letter-archives') }}"><i class="fas fa-mail-bulk"></i> <span>Arsip Surat</span></a>
            </li>
        @endif
        <div class="flex-grow-1"></div>
        <li class="{{ Request::is('settings') ? 'active' : '' }}">
            <a class="nav-link"
               href="{{ route('settings') }}"><i class="fas fa-cog"></i> <span>Pengaturan Akun</span></a>
        </li>
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
