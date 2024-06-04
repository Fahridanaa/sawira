@props(['status' => 'familyMember', 'id' => '', 'iteration' => 0])

@php
    $isHeadFamily = $status === 'headFamily';
    $isFamilyMember = $status === 'familyMember';
@endphp

<div class="card"
     id="{{ $id }}">
    <div class="card-header justify-content-between">
        <h4>Masukkan Data @if($isHeadFamily)
            Kepala Keluarga
            @else
            Anggota Keluarga
            @endif</h4>
        @if($isFamilyMember && url()->current() === route('family-heads.create'))
            <div class="btn-group p-1">
                <button class="btn btn-danger mr-2"
                        id="delete-family-member-card"
                        data-form="{{ $iteration }}">Hapus
                </button>
            </div>
        @endif
    </div>
    <div class="card-body">
        <form class="citizen-form-class">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Status Hubungan Keluarga</label>
                        <select class="form-control"
                                @if($isHeadFamily)
                                    disabled
                                @endif
                                name="id_hubungan"
                                id="id_hubungan">
                            <option disabled
                                    hidden
                                    @if($isFamilyMember)
                                        selected
                                    @endif>Status Hubungan Keluarga
                            </option>
                            <option @if($isHeadFamily)
                                        selected
                                    value="1"
                                    @endif
                                    hidden>Kepala Keluarga
                            </option>
                            <option value="2">Istri</option>
                            <option value="3">Anak</option>
                        </select>
                        @if($isHeadFamily)
                            <input type="hidden"
                                   name="id_hubungan"
                                   id="id_hubungan"
                                   value="1">
                        @endif
                        <div class="invalid-feedback">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-address-book"></i>
                                </div>
                            </div>
                            <input type="text"
                                   class="form-control @error('nik') is-invalid @enderror"
                                   name="nik"
                                   id="nik"
                                   required>
                            <div class="invalid-feedback"
                                 id="nik-error-message-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text"
                                   class="form-control @error('nama_lengkap') is-invalid @enderror"
                                   name="nama_lengkap"
                                   id="nama_lengkap"
                                   required>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="no_telp">No. Telp</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-phone"></i>
                                </div>
                            </div>
                            <input type="text"
                                   class="form-control phone-number @error('no_telp') is-invalid @enderror"
                                   name="no_telp"
                                   id="no_telp">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="agama">Agama</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <select class="form-control @error('agama') is-invalid @enderror"
                                    id="agama"
                                    name="agama">
                                <option disabled
                                        hidden
                                        selected>Pilih Agama
                                </option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen Protestan">Kristen Protestan</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label class="form-label @error('jenis_kelamin') is-invalid @enderror"
                               for="jenis_kelamin">Jenis Kelamin</label>
                        <div class="selectgroup selectgroup-pills">
                            <label class="selectgroup-item"
                                   id="jenis_kelamin">
                                <input type="radio"
                                       name="jenis_kelamin"
                                       value="L"
                                       class="selectgroup-input"
                                       checked="">
                                <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-mars"></i></span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio"
                                       name="jenis_kelamin"
                                       value="P"
                                       class="selectgroup-input">
                                <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-venus"></i></span>
                            </label>
                        </div>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="asal_tempat">Asal Tempat</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-home"></i>
                                </div>
                            </div>
                            <input type="text"
                                   class="form-control @error('asal_tempat') is-invalid @enderror"
                                   name="asal_tempat"
                                   id="asal_tempat">
                            @error('asal_tempat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                            <input type="date"
                                   class="form-control datepicker @error('tanggal_lahir') is-invalid @enderror"
                                   name="tanggal_lahir"
                                   id="tanggal_lahir">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="status_perkawinan">Status Perkawinan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-child"></i>
                                </div>
                            </div>
                            <select class="form-control @error('status_perkawinan') is-invalid @enderror"
                                    id="status_perkawinan"
                                    name="status_perkawinan">
                                <option disabled
                                        hidden
                                        selected>Pilih Status
                                </option>
                                <option value="Kawin">Kawin</option>
                                <option value="Belum Kawin">Belum Kawin</option>
                                <option value="Cerai Hidup">Cerai Hidup</option>
                                <option value="Cerai Mati">Cerai Mati</option>
                            </select>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="kewarganegaraan">Kewarganegaraan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-flag"></i>
                                </div>
                            </div>
                            <select class="form-control @error('kewarganegaraan') is-invalid @enderror"
                                    id="kewarganegaraan"
                                    name="kewarganegaraan">
                                <option disabled
                                        hidden
                                        selected>Pilih Kewarganegaraan
                                </option>
                                <option value="WNI">WNI</option>
                                <option value="WNA">WNA</option>
                            </select>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                            </div>
                            <input type="text"
                                   class="form-control @error('pendidikan_terakhir') is-invalid @enderror"
                                   name="pendidikan_terakhir"
                                   id="pendidikan_terakhir">
                            @error('pendidikan_terakhir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="pekerjaan">Pekerjaan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                            </div>
                            <input type="text"
                                   class="form-control @error('pekerjaan') is-invalid @enderror"
                                   name="pekerjaan"
                                   id="pekerjaan">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
