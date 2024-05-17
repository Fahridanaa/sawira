@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <x-cards.stats-card
                    background="bg-primary"
                    iconType="far"
                    iconName="fa-user"
                    title="Total Penduduk"
                    value="{{ $totalCitizenCount }}">
            </x-cards.stats-card>
            <x-cards.stats-card
                    background="bg-success"
                    iconType="fas"
                    iconName="fa-users"
                    title="Total Kartu Keluarga"
                    value="{{ $totalFamilyCount }}">
            </x-cards.stats-card>
            <x-cards.stats-card
                    background="bg-info"
                    iconType="fas"
                    iconName="fa-flag"
                    title="Total RT"
                    value="{{ $totalRTCount }}">
            </x-cards.stats-card>
        </div>
        <div class="row flex-grow-1 d-flex">
            <x-charts.penduduk-line-chart
                    cardTitle="Penduduk Masuk dan Keluar"
                    cardCategory="2024"
                    :labels="$monthLabels"
                    :entryCitizenData="$entryDataPerMonth"
                    :exitCitizenData="$exitDataPerMonth"
                    chartId="citizensChart">
            </x-charts.penduduk-line-chart>
            <x-charts.usia-penduduk-pie-chart
                    cardTitle="Usia Penduduk"
                    chartId="ageChart"
                    :data="$ageGroupCounts"
                    updatedTime="updated 4 minutes ago">
            </x-charts.usia-penduduk-pie-chart>
        </div>
    </section>
@endsection
@push('js')
    {{--    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>--}}
@endpush

