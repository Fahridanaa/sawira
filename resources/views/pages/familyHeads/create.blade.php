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
                                            <div class="invalid-feedback"
                                                 id="id_provinsi-error-message-feedback">
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
                                            <div class="invalid-feedback"
                                                 id="id_kabupaten-error-message-feedback">
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
                                            <div class="invalid-feedback"
                                                 id="id_kecamatan-error-message-feedback">
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
                                            <div class="invalid-feedback"
                                                 id="id_kelurahan-error-message-feedback">
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
                                            <div class="invalid-feedback"
                                                 id="kode_pos-error-message-feedback">
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
                                            <div class="invalid-feedback"
                                                 id="alamat-error-message-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <x-forms.family-member-form
                            :citizen="$citizen"
                            id="headFamily"
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
@push('js')
    <script type="module">
        $(document).ready(() => {
            const url = window.location.pathname;
            const urlParts = url.split('/');
            const lastPart = urlParts[urlParts.length - 1];

            // console.log('lastPart: ',);

            function onChangeSelect(url, id, name) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        const $elementId = $('#' + name);
                        $elementId.empty();
                        $elementId.append('<option hidden selected disabled>Pilih Salah Satu</option>');
                        $.each(data, function (key, value) {
                            $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }

            $('#id_provinsi').on('change', function () {
                onChangeSelect('{{ route("cities") }}', $(this).val(), 'id_kabupaten');
            });
            $('#id_kabupaten').on('change', function () {
                onChangeSelect('{{ route("districts") }}', $(this).val(), 'id_kecamatan');
            })
            $('#id_kecamatan').on('change', function () {
                onChangeSelect('{{ route("villages") }}', $(this).val(), 'id_kelurahan');
            })

            $('#add-btn').click(function (e) {
                e.preventDefault();

                $('#family-form').trigger('submit');
            });

            $('.citizen-form-class').on('submit', function (e) {
                e.preventDefault();
            });

            $('#family-form').submit(function (e) {
                e.preventDefault();

                let familyData = {};
                let citizens = [];

                $(this).serializeArray().map(function (x) {
                    familyData[x.name] = x.value;
                });

                $('.citizen-form-class').each(function () {
                    let form = $(this);
                    let citizenData = {};

                    let inputs = form.serializeArray();
                    $.each(inputs, function (i, input) {
                        citizenData[input.name] = input.value;
                    });

                    citizens.push(citizenData);
                });

                if (/^\d+$/.test(lastPart)) citizens[0]['id_warga'] = lastPart;

                const postData = {
                    family: familyData,
                    citizens: citizens,
                    _token: "{{ csrf_token() }}"
                };

                $.ajax({
                    type: 'POST',
                    url: '{{ route('family-heads.store') }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        ...postData,
                    },
                    success: function () {
                        window.location.href = '{{ route('penduduk') }}';
                    },
                    error: function (response) {
                        $('input, select').removeClass('is-invalid');
                        if (response.status === 400) {
                            const errors = response.responseJSON.message;
                            $('.invalid-feedback').text('');
                            for (const error in errors) {
                                // Replace periods with underscores for valid ID selectors
                                const errorKey = error.replace(/\./g, '_');
                                const element = $('#' + errorKey);
                                const invalidDiv = element.closest('.form-group').find('.invalid-feedback');
                                element.addClass('is-invalid');
                                invalidDiv.text(errors[error]);
                            }
                        }
                    }
                });
            });

            function addClickHandlerToDeleteButton(iteration) {
                $(`#familyMember-${iteration}`).find("button#delete-family-member-card").click(function () {
                    $(`#familyMember-${iteration}`).remove();
                });
            }

            $("#add-member").click(function () {
                const iteration = $("[id^=familyMember-]").length;
                const newCard = `<x-forms.family-member-form id="familyMember-${iteration}" status="familyMember" iteration="${iteration}" />`;

                $(this).closest('.row').before(newCard);
                addClickHandlerToDeleteButton(iteration);
            });
        });
    </script>
@endpush