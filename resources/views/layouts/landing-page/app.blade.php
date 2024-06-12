<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0"
          name="viewport">
    <title>{{ config('app.name', 'Sawira') }}</title>

    <link href="{{ asset('assets/img/logo-01.svg') }}"
          rel="icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">

    <!-- Main CSS File -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            color: var(--default-color);
            background-color: var(--background-color);
            font-family: var(--default-font) sans-serif;
        }

        a {
            color: var(--accent-color);
            text-decoration: none;
            transition: 0.3s;
        }

        a:hover {
            color: color-mix(in srgb, var(--accent-color), transparent 25%);
            text-decoration: none;
        }

        h1 {
            color: var(--heading-color);
            font-family: var(--heading-font), sans-serif;
        }

        .header {
            color: var(--default-color);
            background-color: var(--background-color);
            padding: 20px 0;
            transition: all 0.5s;
            z-index: 997;
        }

        .scrolled .header {
            box-shadow: 0 0 18px color-mix(in srgb, var(--default-color), transparent 85%);
        }

        .index-page .header {
            --background-color: rgba(255, 255, 255, 0);
        }

        @media screen and (max-width: 768px) {
            [data-aos-delay] {
                transition-delay: 0 !important;
            }
        }
    </style>
    @stack('css')
</head>

<body class="index-page">

<header id="header"
        class="header d-flex align-items-start fixed-top py-3">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center justify-content-center mr-auto">
            <h1 class="sitename ml-2">Sawira</h1>
        </div>
    </div>
</header>

<main class="main">
    @yield('content')
</main>


<!-- Vendor JS Files -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    (function () {
        "use strict";

        function aosInit() {
            AOS.init({
                duration: 600,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });
        }

        window.addEventListener('load', aosInit);

    })();
</script>
@stack('js')
</body>

</html>