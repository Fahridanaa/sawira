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
@push('css')
    <style>
        .main-sidebar .sidebar-menu li a:hover {
            background-color: #f5f5f5;
        }
    </style>
@endpush
@push('js')
    <script type="module">
        const mainSidebar = $(".main-sidebar");
        const body = $("body");
        const w = $(window);
        // Global
        $(function () {
            let sidebar_nicescroll_opts = {
                cursoropacitymin: 0,
                cursoropacitymax: .8,
                zindex: 892
            }, now_layout_class = null;

            let sidebar_nicescroll;
            const update_sidebar_nicescroll = function () {
                let a = setInterval(function () {
                    if (sidebar_nicescroll != null)
                        sidebar_nicescroll.resize();
                }, 10);

                setTimeout(function () {
                    clearInterval(a);
                }, 600);
            }

            const sidebar_dropdown = function () {
                if (mainSidebar.length) {
                    mainSidebar.niceScroll(sidebar_nicescroll_opts);
                    sidebar_nicescroll = mainSidebar.getNiceScroll();

                    $(".main-sidebar .sidebar-menu li a.has-dropdown").off('click').on('click', function () {
                        const me = $(this);
                        let active = false;
                        if (me.parent().hasClass("active")) {
                            active = true;
                        }

                        $('.main-sidebar .sidebar-menu li.active > .dropdown-menu').slideUp(500, function () {
                            update_sidebar_nicescroll();
                            return false;
                        });

                        $('.main-sidebar .sidebar-menu li.active.dropdown').removeClass('active');

                        if (active === true) {
                            me.parent().removeClass('active');
                            me.parent().find('> .dropdown-menu').slideUp(500, function () {
                                update_sidebar_nicescroll();
                                return false;
                            });
                        } else {
                            me.parent().addClass('active');
                            me.parent().find('> .dropdown-menu').slideDown(500, function () {
                                update_sidebar_nicescroll();
                                return false;
                            });
                        }

                        return false;
                    });

                    $('.main-sidebar .sidebar-menu li.active > .dropdown-menu').slideDown(500, function () {
                        update_sidebar_nicescroll();
                        return false;
                    });
                }
            }
            sidebar_dropdown();

            $(".main-content").css({
                minHeight: $(window).outerHeight() - 108
            })

            $(".nav-collapse-toggle").click(function () {
                $(this).parent().find('.navbar-nav').toggleClass('show');
                return false;
            });

            $(document).on('click', function () {
                $(".nav-collapse .navbar-nav").removeClass('show');
            });

            const toggle_sidebar_mini = function (mini) {
                let body = $('body');

                if (!mini) {
                    body.removeClass('sidebar-mini');
                    mainSidebar.css({
                        overflow: 'hidden'
                    });
                } else {
                    body.addClass('sidebar-mini');
                    body.removeClass('sidebar-show');
                }
            }

            $("[data-toggle='sidebar']").click(function () {
                if (w.outerWidth() <= 1024) {
                    if (body.hasClass('sidebar-gone')) {
                        body.removeClass('sidebar-gone');
                        body.addClass('sidebar-show');
                    } else {
                        body.addClass('sidebar-gone');
                        body.removeClass('sidebar-show');
                    }

                    update_sidebar_nicescroll();
                } else {
                    if (body.hasClass('sidebar-mini')) {
                        toggle_sidebar_mini(false);
                    } else {
                        toggle_sidebar_mini(true);
                    }
                }

                return false;
            });

            const toggleLayout = function () {
                const layout_class = $('body').attr('class') || '',
                    layout_classes = (layout_class.trim().length > 0 ? layout_class.split(' ') : '');

                if (layout_classes.length > 0) {
                    layout_classes.forEach(function (item) {
                        if (item.indexOf('layout-') !== -1) {
                            now_layout_class = item;
                        }
                    });
                }

                if (w.outerWidth() <= 1024) {
                    if ($('body').hasClass('sidebar-mini')) {
                        toggle_sidebar_mini(false);
                        $('.main-sidebar').niceScroll(sidebar_nicescroll_opts);
                        sidebar_nicescroll = mainSidebar.getNiceScroll();
                    }

                    body.addClass("sidebar-gone");
                    body.removeClass("sidebar-mini sidebar-show");
                    body.off('click touchend').on('click touchend', function (e) {
                        if ($(e.target).hasClass('sidebar-show') || $(e.target).hasClass('search-show')) {
                            body.removeClass("sidebar-show");
                            body.addClass("sidebar-gone");
                            body.removeClass("search-show");

                            update_sidebar_nicescroll();
                        }
                    });

                    update_sidebar_nicescroll();
                } else {
                    body.removeClass("sidebar-gone sidebar-show");
                    if (now_layout_class) $("body").addClass(now_layout_class);

                    update_sidebar_nicescroll();
                }
            }
            toggleLayout();
            $(window).resize(toggleLayout);
        });

    </script>
@endpush

