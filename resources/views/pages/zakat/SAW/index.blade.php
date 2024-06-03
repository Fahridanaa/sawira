@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Perhitungan Metode Simple Additive Weighting (SAW)</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="progress mb-3"
                         data-height="5"
                         style="height: 5px;">
                        <div class="progress-bar"
                             role="progressbar"
                             aria-valuenow="{{ $step * 14.28571428571429 }}"
                             aria-valuemin="0"
                             aria-valuemax="100"
                             style="width: {{ $step * 14.28571428571429 }}%;">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row"
                                 id="pagination-content">
                                @if ($step == 1)
                                    <x-pagination.spk-criteria/>
                                @elseif ($step == 2)
                                    <x-pagination.spk-criteria-value/>
                                @elseif($step == 3)
                                    <x-pagination.spk-alternative :alternativeSPK="$alternativeSPK"/>
                                @elseif($step == 4)
                                    <x-pagination.spk-alternative-conversion
                                            :alternativeSPKConvert="$alternativeSPKConvert"
                                            :minMax="$minMax"
                                    />
                                @elseif($step == 5)
                                    <x-pagination.spk-alternative-normalized :normalized="$normalized"/>
                                @elseif($step == 6)
                                    <x-pagination.spk-alternative-weighted :weighted="$weighted"/>
                                @elseif($step == 7)
                                    <x-pagination.spk-saw-ranking :sawRank="$sawRank"/>
                                @endif
                            </div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="{{ route('prevSawStep') }}">Previous</a>
                                    </li>
                                    <li class="page-item {{ $step == 1 ? 'active' : '' }}">
                                        <a class="page-link"
                                           href="{{ route('changeSawStep', 1) }}">1</a>
                                    </li>
                                    <li class="page-item {{ $step == 2 ? 'active' : '' }}">
                                        <a class="page-link"
                                           href="{{ route('changeSawStep', 2) }}">2</a>
                                    </li>
                                    <li class="page-item {{ $step == 3 ? 'active' : '' }}">
                                        <a class="page-link"
                                           href="{{ route('changeSawStep', 3) }}">3</a>
                                    </li>
                                    <li class="page-item {{ $step == 4 ? 'active' : '' }}">
                                        <a class="page-link"
                                           href="{{ route('changeSawStep', 4) }}">4</a>
                                    </li>
                                    <li class="page-item {{ $step == 5 ? 'active' : '' }}">
                                        <a class="page-link"
                                           href="{{ route('changeSawStep', 5) }}">5</a>
                                    </li>
                                    <li class="page-item {{ $step == 6 ? 'active' : '' }}">
                                        <a class="page-link"
                                           href="{{ route('changeSawStep', 6) }}">6</a>
                                    </li>
                                    <li class="page-item {{ $step == 7 ? 'active' : '' }}">
                                        <a class="page-link"
                                           href="{{ route('changeSawStep', 7) }}">7</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="{{ route('nextSawStep') }}">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection