@extends('layouts.error')
@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="page-error">
                <div class="page-inner">
                    <h1>500</h1>
                    <div class="page-description">
                        Wah, sepertinya ada yang salah dengan server kami.
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
