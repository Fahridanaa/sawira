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
    <link rel="stylesheet"
          href="{{ asset('build/' . json_decode(file_get_contents(public_path('build/manifest.json')), true)['resources/js/app.css']['file']) }}">
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
    <div class="main-panel ps-container ps-theme-default ps-active-y">
        @include('layouts.navbar')
        <div class="content d-flex flex-column">
            <div class="container-fluid d-flex flex-column flex-grow-1">
                @yield("content")
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('build/' . json_decode(file_get_contents(public_path('build/manifest.json')), true)['resources/js/app.js']['file']) }}"></script>
@stack('js')
</body>
</html>