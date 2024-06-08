@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Menambah Kartu Keluarga</h1>
            <div class="btn-group p-1">
                <a href="{{ route('penduduk') }}">
                    <button class="btn btn-danger mr-2">
                        Batal
                    </button>
                </a>
                <button class="btn btn-primary ml-2"
                        id="add-btn">Simpan
                </button>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Masukkan Data Keluarga</h4>
                        </div>
                        <div class="card-body">
                            <form id="family-form">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="no_kk">No. KK</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="no_kk"
                                                   id="no_kk"
                                                   required>
                                            <div class="invalid-feedback"
                                                 id="no_kk-error-message-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h4 style="font-size: 1rem">Alamat</h4>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="id_provinsi">Provinsi</label>
                                            <select class="form-control"
                                                    name="id_provinsi"
                                                    id="id_provinsi"
                                                    required>
                                                @if(isset($provinces))
                                                    <option disabled
                                                            hidden
                                                            selected>Pilih Salah Satu
                                                    </option>
                                                    @foreach ($provinces as $item)
                                                        <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="id_kabupaten">Kabupaten/Kota</label>
                                            <select class="form-control"
                                                    name="id_kabupaten"
                                                    id="id_kabupaten"
                                                    required>
                                            </select>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="id_kecamatan">Kecamatan</label>
                                            <select class="form-control"
                                                    name="id_kecamatan"
                                                    id="id_kecamatan"
                                                    required>
                                            </select>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="id_kelurahan">Desa/Kelurahan</label>
                                            <select class="form-control"
                                                    name="id_kelurahan"
                                                    id="id_kelurahan"
                                                    required>
                                            </select>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="kode_pos">Kode Pos</label>
                                            <input type="text"
                                                   class="form-control @error('kode_pos') is-invalid @enderror"
                                                   name="kode_pos"
                                                   id="kode_pos"
                                                   required>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="alamat"
                                                   id="alamat"
                                                   required>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <x-forms.family-member-form id="headFamily"
                                                status="headFamily"
                                                iteration=0
                    />
                    <div class="row pb-5">
                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn btn-primary"
                                    id="add-member">Tambah Anggota Keluarga Lainnya
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection