@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Edit Kartu Keluarga</h1>
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
                                {!! method_field('PUT') !!}
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="no_kk">No. KK</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="no_kk"
                                                   id="no_kk"
                                                   {{ $family->no_kk ? 'value= ' . $family->no_kk : ''}}
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
                                                            {{ ($family) ? '' : 'selected' }}>Pilih Salah Satu
                                                    </option>
                                                    @foreach ($provinces as $item)
                                                        <option value="{{ $item->id ?? '' }}"
                                                        @if($family)
                                                            {{ ($family->id_provinsi === $item->id) ? 'selected' : ''}}
                                                                @endif
                                                        >{{ $item->name ?? '' }}</option>
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
                                                   {{ $family->kode_pos ? 'value= ' . $family->kode_pos : ''}}
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
                                                   {{ $family->alamat ? 'value= ' . $family->alamat : ''}}
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
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script type="module">
        $(document).ready(function () {
            const id_provinsi = $('#id_provinsi');
            const id_kabupaten = $('#id_kabupaten');
            const id_kecamatan = $('#id_kecamatan');
            onChangeSelect('{{ route("cities") }}', {{ $province->id }}, {{ $cities->id }}, '{{ $cities->name }}', 'id_kabupaten');
            onChangeSelect('{{ route("districts") }}', {{ $cities->id }}, {{ $districts->id }}, '{{ $districts->name }}', 'id_kecamatan');
            onChangeSelect('{{ route("villages") }}', {{ $districts->id }}, {{ $villages->id }}, '{{ $villages->name }}', 'id_kelurahan');

            id_provinsi.on('change', function () {
                onChangeSelect('{{ route("cities") }}', $(this).val(), 'id_kabupaten');
            });
            id_kabupaten.on('change', function () {
                onChangeSelect('{{ route("districts") }}', $(this).val(), 'id_kecamatan');
            })
            id_kecamatan.on('change', function () {
                onChangeSelect('{{ route("villages") }}', $(this).val(), 'id_kelurahan');
            })

            function onChangeSelect(url, id, requestId, requestName, name) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        const $elementId = $('#' + name);
                        $elementId.empty();
                        {{--$elementId.append('<option hidden disabled {{ ($family) ? '' : 'selected' }}>Pilih Salah Satu</option>');--}}
                        $($elementId).append('<option value="' + requestId + '" selected hidden>' + requestName + '</option>');
                        $.each(data, function (key, value) {
                            $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }

            $('#add-btn').click(function (e) {
                e.preventDefault();

                $('#family-form').trigger('submit');
            });

            $('#family-form').submit(function (e) {
                e.preventDefault();

                let familyData = {};

                $(this).serializeArray().map(function (x) {
                    familyData[x.name] = x.value;
                });


                $.ajax({
                    type: 'POST',
                    url: '{{ route('family-heads.update', $family->id_kk) }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        ...familyData,
                    },
                    success: function () {
                        window.location.href = '{{ route('penduduk') }}';
                    },
                    error: function (response) {
                        $('input').removeClass('is-invalid');
                        $('select').removeClass('is-invalid');
                        if (response.status === 400) {
                            const errors = response.responseJSON.message;
                            $('.invalid-feedback').text('');
                            for (const error in errors) {
                                const element = $('#' + error);
                                const invalidDiv = element.closest('.form-group').find('.invalid-feedback');
                                element.addClass('is-invalid');
                                invalidDiv.text(errors[error]);
                            }
                        } else if (response.status === 401) {
                            $('#no_kk').addClass('is-invalid');
                            $('#no_kk-error-message-feedback').text(response.responseJSON.message)
                        } else if (response.status === 402) {
                            $('#nik').addClass('is-invalid');
                            $('#nik-error-message-feedback').text(response.responseJSON.message)
                        }

                    }
                });
            })
        })
    </script>
@endpush