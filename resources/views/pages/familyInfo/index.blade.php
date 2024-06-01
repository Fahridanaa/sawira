@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Informasi Keluarga</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Kartu Keluarga</h2>
            <p class="section-lead"><span>No. KK: </span>{{ $familyInformation['no_kk'] }}</p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{--                        <div class="card-header pb-0">--}}
                        {{--                        </div>--}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="text-dark ">Informasi Umum</h6>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6 col-md-3">
                                            <div><span class="font-weight-bold">Kepala Keluarga</span></div>
                                            <div><span class="font-weight-bold">Alamat</span></div>
                                            <div><span class="font-weight-bold">RT/RW</span></div>
                                            <div><span class="font-weight-bold">Kelurahan/Desa</span></div>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div id="kepala_keluarga">{{ $familyInformation['kepalaKeluarga'] }}</div>
                                            <div id="alamat">{{ $familyInformation['alamat'] }}</div>
                                            <div id="rt_rw">{{ $familyInformation['id_rt'] }}/11</div>
                                            <div id="desa">{{ $familyInformation['kelurahan'] }}</div>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div><span class="font-weight-bold">Kecamatan</span></div>
                                            <div><span class="font-weight-bold">Kabupaten</span></div>
                                            <div><span class="font-weight-bold">Kode Pos</span></div>
                                            <div><span class="font-weight-bold">Provinsi</span></div>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div id="kecamatan">{{ $familyInformation['kecamatan'] }}</div>
                                            <div id="kabupaten">{{ $familyInformation['kabupaten'] }}</div>
                                            <div id="kode_pos">{{ $familyInformation['kode_pos'] }}</div>
                                            <div id="provinsi">{{ $familyInformation['provinsi'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="text-dark ">Kondisi Keluarga</h6>
                                        <div class="btn-group">
                                            <button class="btn btn-primary btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#family-condition-form-modal">Edit
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 col-md-3">
                                                    <div><span class="font-weight-bold">Penghasilan</span></div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div id="jumlah_penghasilan">{{ $familyInformation['jumlah_penghasilan'] ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 col-md-3">
                                                    <div><span class="font-weight-bold">Jumlah Pengeluaran</span></div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div id="jumlah_pengeluaran">{{ $familyInformation['jumlah_pengeluaran'] ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 col-md-3">
                                                    <div><span class="font-weight-bold">Jumlah Hutang</span></div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div id="jumlah_hutang">{{ $familyInformation['jumlah_hutang'] ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 col-md-3">
                                                    <div><span class="font-weight-bold">Jumlah Tanggungan</span></div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div id="jumlah_tanggungan">{{ $familyInformation['jumlah_tanggungan'] ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 col-md-3">
                                                    <div><span class="font-weight-bold">Kondisi Tempat Tinggal</span>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div id="kondisi_tempat_tinggal">{{ $familyInformation['kondisi_tempat'] ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modal.family-condition-form-modal
            :familyInformation="$familyInformation"
    />
@endsection
