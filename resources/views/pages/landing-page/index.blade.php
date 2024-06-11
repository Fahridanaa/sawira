@extends('layouts.landing-page.app')
@section('content')
    <section id="hero"
             class="hero section"
             style="background: url({{ asset('assets/img/hero-bg.png') }}) top center no-repeat">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Sistem Administrasi Warga dan Informasi Rukun Warga</h1>
                    <p data-aos="fade-up"
                       data-aos-delay="100">Aplikasi E-Government berbasis web yang dirancang untuk membantu memenuhi
                                            kebutuhan administrasi
                                            dan manajemen</p>
                    <div class="d-flex flex-column flex-md-row"
                         data-aos="fade-up"
                         data-aos-delay="200">
                        <a href="{{ route('login') }}"
                           class="btn-get-started">Login</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img"
                     data-aos="zoom-out">
                    <img src="{{ asset('assets/img/hero-img.png') }}"
                         class="img-fluid animated"
                         alt="">
                </div>
            </div>
        </div>
    </section>
@endsection
@push('css')
    <style>
        section,
        .section {
            color: var(--default-color);
            background-color: var(--background-color);
            padding: 60px 0;
            scroll-margin-top: 98px;
            overflow: clip;
        }

        @media (max-width: 1199px) {
            section,
            .section {
                scroll-margin-top: 56px;
            }
        }

        .hero {
            width: 100%;
            min-height: 100vh;
            position: relative;
            padding: 80px 0 60px 0;
            display: flex;
            align-items: center;
            background-size: cover;
        }

        .hero h1 {
            margin: 0;
            font-size: 48px;
            font-weight: 700;
            line-height: 56px;
        }

        .hero p {
            color: color-mix(in srgb, var(--default-color), transparent 30%);
            margin: 5px 0 30px 0;
            font-size: 20px;
            font-weight: 400;
        }

        .hero .btn-get-started {
            color: var(--contrast-color);
            background: var(--accent-color);
            font-family: var(--heading-font);
            font-weight: 500;
            font-size: 16px;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 40px;
            border-radius: 4px;
            transition: 0.5s;
            box-shadow: 0 8px 28px color-mix(in srgb, var(--accent-color), transparent 80%);
        }

        .hero .btn-get-started i {
            margin-left: 5px;
            font-size: 18px;
            transition: 0.3s;
        }

        .hero .btn-get-started:hover {
            color: var(--contrast-color);
            background: color-mix(in srgb, var(--accent-color), transparent 15%);
            box-shadow: 0 8px 28px color-mix(in srgb, var(--accent-color), transparent 55%);
        }

        .hero .btn-get-started:hover i {
            transform: translateX(5px);
        }

        .hero .btn-watch-video i {
            color: var(--accent-color);
            font-size: 32px;
            transition: 0.3s;
            line-height: 0;
            margin-right: 8px;
        }

        .hero .btn-watch-video:hover i {
            color: color-mix(in srgb, var(--accent-color), transparent 15%);
        }

        .hero .animated {
            animation: up-down 2s ease-in-out infinite alternate-reverse both;
        }

        @media (max-width: 640px) {
            .hero h1 {
                font-size: 28px;
                line-height: 36px;
            }

            .hero p {
                font-size: 18px;
                line-height: 24px;
                margin-bottom: 30px;
            }
        }

        @keyframes up-down {
            0% {
                transform: translateY(10px);
            }

            100% {
                transform: translateY(-10px);
            }
        }
    </style>
@endpush