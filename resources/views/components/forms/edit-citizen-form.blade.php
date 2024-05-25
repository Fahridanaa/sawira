@props(['citizen_id' => 0, 'id_hubungan' => 0, 'nik' => '', 'name' => '', 'no_telp' => '', 'agama' => '', 'kelamin' => '',
'asal_tempat' => '', 'tanggal_lahir' => '', 'pendidikan' => '', 'pekerjaan' => ''])

<div class="card">
    <div class="card-header justify-content-between">
        <h4>Edit Data Warga</h4>
    </div>
    <div class="card-body">
        <form id="edit-citizen-form">
            @csrf
            {!! method_field('PUT') !!}
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Status Hubungan Keluarga</label>
                        <select class="form-control"
                                name="id_hubungan_select"
                                id="id_hubungan_select"
                                @if($id_hubungan === 1) disabled @endif>
                            <option disabled
                                    hidden
                                    selected>Status Hubungan Keluarga
                            </option>
                            <option value="1"
                                    hidden
                                    disabled
                                    @if($id_hubungan === 1) selected @endif>Kepala Keluarga
                            </option>
                            <option value="2"
                                    @if($id_hubungan === 2) selected @endif>Istri
                            </option>
                            <option value="3"
                                    @if($id_hubungan === 3) selected @endif>Anak
                            </option>
                        </select>
                        <input type="hidden"
                               name="id_hubungan"
                               id="id_hubungan"
                               value="{{$id_hubungan === 1}}">
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
                                   class="form-control"
                                   name="nik"
                                   id="nik"
                                   value="{{ $nik }}"
                                   required>
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
                                   class="form-control"
                                   name="nama_lengkap"
                                   id="nama_lengkap"
                                   value="{{ $name }}"
                                   required>
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
                                   class="form-control phone-number"
                                   value="{{ $no_telp }}"
                                   name="no_telp"
                                   id="no_telp">
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
                            <select class="form-control"
                                    id="agama"
                                    name="agama">
                                <option disabled
                                        hidden
                                        selected>Pilih Agama
                                </option>
                                <option value="Islam"
                                        @if($agama === "Islam") selected @endif>Islam
                                </option>
                                <option value="Kristen Protestan"
                                        @if($agama === "Kristen Protestan") selected @endif>Kristen Protestan
                                </option>
                                <option value="Katolik"
                                        @if($agama === "Katolik") selected @endif>Katolik
                                </option>
                                <option value="Hindu"
                                        @if($agama === "Hindu") selected @endif>Hindu
                                </option>
                                <option value="Buddha"
                                        @if($agama === "Buddha") selected @endif>Buddha
                                </option>
                                <option value="Konghucu"
                                        @if($agama === "Konghucu") selected @endif>Konghucu
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label class="form-label"
                               for="jenis_kelamin">Jenis Kelamin</label>
                        <div class="selectgroup selectgroup-pills">
                            <label class="selectgroup-item"
                                   id="jenis_kelamin">
                                <input type="radio"
                                       name="jenis_kelamin"
                                       value="L"
                                       class="selectgroup-input"
                                       @if($kelamin !== "P") checked @endif>
                                <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-mars"></i></span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio"
                                       name="jenis_kelamin"
                                       value="P"
                                       class="selectgroup-input"
                                       @if($kelamin === "P") checked @endif>
                                <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-venus"></i></span>
                            </label>
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
                                   class="form-control"
                                   value="{{ $asal_tempat }}"
                                   name="asal_tempat"
                                   id="asal_tempat">
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
                            @php
                                $date = new DateTime($tanggal_lahir);
                            @endphp
                            <input type="date"
                                   class="form-control datepicker"
                                   value="{{ $date->format('Y-m-d') }}"
                                   name="tanggal_lahir"
                                   id="tanggal_lahir">
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
                                   class="form-control"
                                   value="{{ $pendidikan }}"
                                   name="pendidikan_terakhir"
                                   id="pendidikan_terakhir">
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
                                   class="form-control"
                                   value="{{ $pekerjaan }}"
                                   name="pekerjaan"
                                   id="pekerjaan">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@push('js')
    <script type="module">
        $('#id_hubungan_select').change(function () {
            $('#id_hubungan').val($(this).val());
        });
    </script>
@endpush
