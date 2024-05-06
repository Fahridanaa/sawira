<!doctype html>
<html lang="en">
<head>
    <title>{{ config('app.name', 'Sawira') }}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
          name="viewport"/>

    <meta http-equiv="X-UA-Compatible"
          content="IE=edge,chrome=1"/>

    <!--     Fonts and icons     -->
    <link rel="stylesheet"
          type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="preconnect"
          href="https://fonts.googleapis.com">
    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
          rel="stylesheet">
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>

    <!-- Material Dashboard CSS -->
    <link rel="stylesheet"
          href="{{ asset("material-dashboard/assets/css/material-dashboard.css") }}">

    @stack("css")
</head>
<body>
<div class="wrapper">
    <div class="sidebar"
         data-color="green"
         data-background-color="white"
         data-image="{{ 'material-dashboard/assets/img/sidebar-1.jpg' }}">
        @include('layouts.sidebar')
    </div>
    <div class="main-panel ps-container ps-theme-default ps-active-y"
         data-ps-id="567f00be-16bf-3238-5beb-1eef2e6eee73">
        @include('layouts.navbar')
        <div class="content">
            <div class="container-fluid">
                @yield("content")
            </div>
        </div>
        {{--        <footer class="footer">--}}
        {{--            <div class="container-fluid">--}}
        {{--                <!-- your footer here -->--}}
        {{--            </div>--}}
        {{--        </footer>--}}
    </div>
</div>

<!--   Core JS Files   -->
<script src="{{ asset("material-dashboard/assets/js/core/jquery.min.js") }}"
        type="text/javascript"></script>
<script src="{{ asset("material-dashboard/assets/js/core/popper.min.js") }}"
        type="text/javascript"></script>
<script src="{{ asset("material-dashboard/assets/js/core/bootstrap-material-design.min.js") }}"
        type="text/javascript"></script>

<!-- Plugin for the Perfect Scrollbar -->
<script src="{{ asset("material-dashboard/assets/js/plugins/perfect-scrollbar.jquery.min.js") }}"></script>

<!-- Plugin for the momentJs  -->
<script src="{{ asset("material-dashboard/assets/js/plugins/moment.min.js") }}"></script>

<!--  Plugin for Sweet Alert -->
<script src="{{ asset("material-dashboard/assets/js/plugins/sweetalert2.js") }}"></script>

<!-- Forms Validations Plugin -->
<script src="{{ asset("material-dashboard/assets/js/plugins/jquery.validate.min.js") }}"></script>

<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{ asset("material-dashboard/assets/js/plugins/jquery.bootstrap-wizard.js") }}"></script>

<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ asset("material-dashboard/assets/js/plugins/bootstrap-selectpicker.js") }}"></script>

<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{ asset("material-dashboard/assets/js/plugins/bootstrap-datetimepicker.min.js") }}"></script>

<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="{{ asset("material-dashboard/assets/js/plugins/jquery.datatables.min.js") }}"></script>

<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{ asset("material-dashboard/assets/js/plugins/bootstrap-tagsinput.js") }}"></script>

<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ asset("material-dashboard/assets/js/plugins/jasny-bootstrap.min.js") }}"></script>

<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{ asset("material-dashboard/assets/js/plugins/fullcalendar.min.js") }}"></script>

<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{ asset("material-dashboard/assets/js/plugins/jquery-jvectormap.js") }}"></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset("material-dashboard/assets/js/plugins/nouislider.min.js") }}"></script>

<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>--}}

<!-- Library for adding dinamically elements -->
<script src="{{ asset("material-dashboard/assets/js/plugins/arrive.min.js") }}"></script>

<!--  Google Maps Plugin    -->
{{--<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>--}}

<!-- Chartist JS -->
<script src="{{ asset("material-dashboard/assets/js/plugins/chartist.min.js") }}"></script>

<!--  Notifications Plugin    -->
<script src="{{ asset("material-dashboard/assets/js/plugins/bootstrap-notify.js") }}"></script>

<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset("material-dashboard/assets/js/material-dashboard.js") }}"
        type="text/javascript"></script>
@stack('js')
</body>
</html>