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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="text-dark ">Informasi Umum</h6>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="kepala_keluarga">Kepala Keluarga</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                           class="form-control"
                                                           name="kepala_keluarga"
                                                           id="kepala_keluarga"
                                                           value="{{ $familyInformation['kepalaKeluarga'] ?? 'N/A' }}"
                                                           disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                           class="form-control"
                                                           name="kecamatan"
                                                           id="kecamatan"
                                                           value="{{ $familyInformation['kecamatan'] ?? 'N/A' }}"
                                                           disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                           class="form-control"
                                                           name="alamat"
                                                           id="alamat"
                                                           value="{{ $familyInformation['alamat'] ?? 'N/A' }}"
                                                           disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="kabupaten">Kabupaten</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                           class="form-control"
                                                           name="kabupaten"
                                                           id="kabupaten"
                                                           value="{{ $familyInformation['kabupaten'] ?? 'N/A' }}"
                                                           disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-12 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="id_rt">RT</label>
                                                        <div class="input-group">
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="id_rt"
                                                                   id="id_rt"
                                                                   value="{{ $familyInformation['id_rt'] ?? 'N/A' }}"
                                                                   disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="id_rt">RW</label>
                                                        <div class="input-group">
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="id_rt"
                                                                   id="id_rt"
                                                                   value="11"
                                                                   disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="kode_pos">Kode Pos</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                           class="form-control"
                                                           name="kode_pos"
                                                           id="kode_pos"
                                                           value="{{ $familyInformation['kode_pos'] ?? 'N/A' }}"
                                                           disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="kelurahan">Kelurahan/Desa</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                           class="form-control"
                                                           name="kelurahan"
                                                           id="kelurahan"
                                                           value="{{ $familyInformation['kelurahan'] ?? 'N/A' }}"
                                                           disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="provinsi">Provinsi</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                           class="form-control"
                                                           name="provinsi"
                                                           id="provinsi"
                                                           value="{{ $familyInformation['provinsi'] ?? 'N/A' }}"
                                                           disabled>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="family-condition-form"
                                  method="post"
                                  action="{{ route('informasi-keluarga.update', ['informasi_keluarga' => $familyInformation['id_kondisi_keluarga']]) }}">
                                @csrf
                                {!! method_field('PUT') !!}
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="text-dark ">Kondisi Keluarga</h6>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="jumlah_penghasilan">Penghasilan</label>
                                                    <div class="input-group">
                                                        <input type="number"
                                                               class="form-control"
                                                               name="jumlah_penghasilan"
                                                               id="jumlah_penghasilan"
                                                               placeholder="{{ $familyInformation['jumlah_penghasilan'] ?? 'N/A' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="jumlah_pengeluaran">Jumlah Pengeluaran</label>
                                                    <div class="input-group">
                                                        <input type="number"
                                                               class="form-control"
                                                               name="jumlah_pengeluaran"
                                                               id="jumlah_pengeluaran"
                                                               placeholder="{{ $familyInformation['jumlah_pengeluaran'] ?? 'N/A' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="jumlah_hutang">Jumlah Hutang</label>
                                                    <div class="input-group">
                                                        <input type="number"
                                                               class="form-control"
                                                               name="jumlah_hutang"
                                                               id="jumlah_hutang"
                                                               placeholder="{{ $familyInformation['jumlah_hutang'] ?? 'N/A' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="jumlah_tanggungan">Jumlah Tanggungan</label>
                                                    <div class="input-group">
                                                        <input type="number"
                                                               class="form-control"
                                                               name="jumlah_tanggungan"
                                                               id="jumlah_tanggungan"
                                                               placeholder="{{ $familyInformation['jumlah_tanggungan'] ?? 'N/A' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="kondisi_tempat_tinggal">Kondisi Tempat Tinggal</label>
                                                    <select class="form-control"
                                                            name="kondisi_tempat_tinggal"
                                                            id="kondisi_tempat_tinggal"
                                                            required>
                                                        <option disabled
                                                                hidden
                                                                selected>Pilih Kondisi Tempat Tinggal
                                                        </option>
                                                        <option value="1"
                                                                @if($familyInformation['kondisi_tempat_tinggal'] === 1) selected @endif>
                                                            Sangat Layak (kondisi baik)
                                                        </option>
                                                        <option value="2"
                                                                @if($familyInformation['kondisi_tempat_tinggal'] === 2) selected @endif>
                                                            Layak (perlu sedikit perbaikan)
                                                        </option>
                                                        <option value="3"
                                                                @if($familyInformation['kondisi_tempat_tinggal'] === 3) selected @endif>
                                                            Cukup Layak (rusak ringan)
                                                        </option>
                                                        <option value="4"
                                                                @if($familyInformation['kondisi_tempat_tinggal'] === 4) selected @endif>
                                                            Tidak Layak (rusak sedang)
                                                        </option>
                                                        <option value="5"
                                                                @if($familyInformation['kondisi_tempat_tinggal'] === 5) selected @endif>
                                                            Sangat Tidak Layak (rusak berat)
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end">
                                                <div class="btn-group">
                                                    <button type="submit"
                                                            class="btn btn-primary">Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
