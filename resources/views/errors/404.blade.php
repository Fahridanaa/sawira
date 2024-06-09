@extends('layouts.error')
@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="page-error">
                <div class="page-inner">
                    <h1>404</h1>
                    <div class="page-description">
                        Wah, sepertinya halaman yang kamu cari tidak ditemukan.
                    </div>
                    <div class="page-search">
                        <div class="mt-3">
                            <a href="{{ route('dashboard') }}">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection