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
    <link href="https://fonts.googleapis.com"
          rel="preconnect">
    <link href="https://fonts.gstatic.com"
          rel="preconnect"
          crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
          crossorigin="anonymous">

    <!-- Main CSS File -->
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        :root {
            --default-font: "Roboto", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --heading-font: "Nunito", sans-serif;
            --nav-font: "Poppins", sans-serif;
        }

        :root {
            --background-color: #ffffff; /* Background color for the entire website, including individual sections */
            --default-color: #444444; /* Default color used for the majority of the text content across the entire website */
            --heading-color: #012970; /* Color for headings, subheadings and title throughout the website */
            --accent-color: #4154f1; /* Accent color that represents your brand on the website. It's used for buttons, links, and other elements that need to stand out */
            --contrast-color: #ffffff; /* The contrast color is used for elements when the background color is one of the heading, accent, or default colors. Its purpose is to ensure proper contrast and readability when placed over these more dominant colors */
        }

        /* Nav Menu Colors - The following color variables are used specifically for the navigation menu. They are separate from the global colors to allow for more customization options */
        :root {
            --nav-color: #012970; /* The default color of the main navmenu links */
            --nav-hover-color: #4154f1; /* Applied to main navmenu links when they are hovered over or active */
            --nav-dropdown-background-color: #ffffff; /* Used as the background color for dropdown items that appear when hovering over primary navigation items */
            --nav-dropdown-color: #212529; /* Used for navigation links of the dropdown items in the navigation menu. */
            --nav-dropdown-hover-color: #4154f1; /* Similar to --nav-hover-color, this color is applied to dropdown navigation links when they are hovered over. */
        }

        /* Smooth scroll */
        :root {
            scroll-behavior: smooth;
        }

        /*--------------------------------------------------------------
        # General
        --------------------------------------------------------------*/
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

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--heading-color);
            font-family: var(--heading-font);
        }

        .header {
            color: var(--default-color);
            background-color: var(--background-color);
            padding: 20px 0;
            transition: all 0.5s;
            z-index: 997;
        }

        .header .logo {
            line-height: 1;
        }

        .header .logo img {
            max-height: 36px;
            margin-right: 8px;
        }

        .header .logo h1 {
            font-size: 30px;
            margin: 0;
            font-weight: 700;
            color: var(--heading-color);
        }

        .scrolled .header {
            box-shadow: 0px 0 18px color-mix(in srgb, var(--default-color), transparent 85%);
        }

        .index-page .header {
            --background-color: rgba(255, 255, 255, 0);
        }

        .index-page.scrolled .header {
            --background-color: #ffffff;
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
@stack('js')
</body>

</html>