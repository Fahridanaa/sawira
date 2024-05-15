@extends('layouts.template')
@section('content')
    <div class="row">
        <x-cards.stats-card
                color="success"
                icon="people"
                category="Penduduk"
                title="{{ $jumlahWarga }}"
                footerText="Kelola Data Penduduk">
        </x-cards.stats-card>
        <x-cards.stats-card
                color="info"
                icon="family_restroom"
                category="Kartu Keluarga"
                title="{{ $jumlahKK }}"
                footerText="Kelola Kartu Keluarga">
        </x-cards.stats-card>
        <x-cards.stats-card
                color="warning"
                icon="history"
                category="Riwayat Penduduk"
                title="{{ $jumlahRT }}"
                footerText="Riwayat Penduduk">
        </x-cards.stats-card>
    </div>
    <div class="row flex-grow-1 d-flex">
        <x-charts.penduduk-line-chart
                cardTitle="Penduduk Masuk dan Keluar"
                cardCategory="2024"
                chartId="citizensChart"
                :labels="$labels"
                :values="$values"
                :valuess="$values1"
                updatedTime="updated 4 minutes ago">
        </x-charts.penduduk-line-chart>
        <x-charts.usia-penduduk-pie-chart
                cardTitle="Usia Penduduk"
                chartId="ageChart"
                :data="$usiaPendudukArray"
                updatedTime="updated 4 minutes ago">
        </x-charts.usia-penduduk-pie-chart>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

