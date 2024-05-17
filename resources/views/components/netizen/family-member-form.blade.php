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
        @if($isFamilyMember)
            <div class="btn-group p-1">
                <button class="btn btn-danger mr-2"
                        id="delete-family-member-card"
                        data-form="{{ $iteration }}">Hapus
                </button>
            </div>
        @endif
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label>Status Hubungan Keluarga</label>
                        <select class="form-control"
                                @if($isHeadFamily)
                                    disabled
                                @endif>
                            <option disabled
                                    hidden
                                    @if($isFamilyMember)
                                        selected
                                    @endif>Status Hubungan Keluarga
                            </option>
                            <option @if($isHeadFamily)
                                        selected
                                    @endif
                                    hidden>Kepala Keluarga
                            </option>
                            <option>Istri</option>
                            <option>Anak</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>NIK</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-address-book"></i>
                                </div>
                            </div>
                            <input type="text"
                                   class="form-control"
                                   required>
                        </div>

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text"
                                   class="form-control"
                                   required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>No. Telp</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-phone"></i>
                                </div>
                            </div>
                            <input type="text"
                                   class="form-control phone-number">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Agama</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <select class="form-control">
                                <option disabled
                                        hidden
                                        selected>Pilih Agama
                                </option>
                                <option>Islam</option>
                                <option>Kristen Protestan</option>
                                <option>Katolik</option>
                                <option>Hindu</option>
                                <option>Buddha</option>
                                <option>Khonghucu</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label>
                        <div class="selectgroup selectgroup-pills">
                            <label class="selectgroup-item">
                                <input type="radio"
                                       name="icon-input"
                                       value="1"
                                       class="selectgroup-input"
                                       checked="">
                                <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-mars"></i></span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio"
                                       name="icon-input"
                                       value="2"
                                       class="selectgroup-input">
                                <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-venus"></i></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                            </div>
                            <input type="text"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                            </div>
                            <input type="text"
                                   class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>