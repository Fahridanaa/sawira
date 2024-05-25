<form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
        <li><a href="#"
               data-toggle="sidebar"
               id="burger"
               class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
</form>
<ul class="navbar-nav navbar-right">
    <li>
        <span class="nav-link nav-link-lg nav-link-user">
            <img alt="image"
                 src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                 class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->username }}</div>
        </span>
    </li>
</ul>
