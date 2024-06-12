@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <x-cards.stat-card
                    background="bg-primary"
                    iconType="far"
                    iconName="fa-user"
                    title="Total Penduduk"
                    value="{{ $totalCitizenCount }}"
            />
            <x-cards.stat-card
                    background="bg-success"
                    iconType="fas"
                    iconName="fa-users"
                    title="Total Kartu Keluarga"
                    value="{{ $totalFamilyCount }}"
            />
            <x-cards.stat-card
                    background="bg-info"
                    iconType="fas"
                    iconName="fa-flag"
                    title="Total RT"
                    value="{{ $totalRTCount }}"
            />
        </div>
        <div class="row flex-grow-1 d-flex">
            <x-charts.total-citizens-bar-chart
                    cardTitle="Jumlah Penduduk"
                    :genderManStatistics="$genderManStatistics"
                    :genderWomanStatistics="$genderWomanStatistics"
            />
            <x-charts.usia-penduduk-pie-chart
                    cardTitle="Usia Penduduk"
                    chartId="ageChart"
                    :ageGroupData="$ageGroupCounts"
            />
        </div>
    </section>
@endsection
