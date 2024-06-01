@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pembagian Zakat</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <span>Jumlah Beras yang dibutuhkan: </span>
                                </div>
                            </div>
                            <ul class="nav nav-tabs"
                                id="myTab"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link"
                                       id="ahp-tab"
                                       data-toggle="tab"
                                       href="#ahp"
                                       role="tab"
                                       aria-controls="home"
                                       aria-selected="false">AHP</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active show"
                                       id="saw-tab"
                                       data-toggle="tab"
                                       href="#saw"
                                       role="tab"
                                       aria-controls="profile"
                                       aria-selected="true">SAW</a>
                                </li>
                            </ul>
                            <div class="tab-content"
                                 id="myTabContent">
                                <div class="tab-pane fade"
                                     id="ahp"
                                     role="tabpanel"
                                     aria-labelledby="ahp-tab">
                                    AHP
                                </div>
                                <div class="tab-pane fade active show"
                                     id="saw"
                                     role="tabpanel"
                                     aria-labelledby="saw-tab">
                                    SAW
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection