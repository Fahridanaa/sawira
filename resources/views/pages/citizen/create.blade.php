@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Menambah Penduduk</h1>
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
                            <h4>Pilih Data No. KK</h4>
                        </div>
                        <div class="card-body">
                            <form method="post"
                                  action="{{ route('citizens.store') }}"
                                  id="family-member-form">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="id_kk">No. KK</label>
                                            <select class="form-control"
                                                    name="id_kk"
                                                    id="id_kk"
                                                    required>
                                                <option disabled
                                                        hidden
                                                        selected>Pilih No. KK
                                                </option>
                                                @foreach($kkRecords as $no_kk)
                                                    <option value="{{ $no_kk->id_kk }}">
                                                        {{ $no_kk->no_kk }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="kepala_keluarga">Nama Kepala Keluarga</label>
                                            <input type="text"
                                                   class="form-control"
                                                   id="kepala_keluarga"
                                                   name="kepala_keluarga"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <x-forms.family-member-form
                            id="familyMember"
                            status="familyMember"
                            iteration=0
                    />
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script type="module">
        $(document).ready(function () {
            const headFamilyRecords = JSON.parse('{!! $headFamilyRecords !!}');

            $('#id_kk').change(function () {
                const selectedId = $(this).val();
                const headFamilyName = headFamilyRecords[selectedId];
                $('#kepala_keluarga').val(headFamilyName);
            });

            $('#add-btn').click(function (e) {
                e.preventDefault();
                $('#family-member-form').trigger('submit');
            });

            $('#family-member-form').on('submit', function (e) {
                e.preventDefault();

                let citizenData = {};

                $(this).serializeArray().map(function (x) {
                    citizenData[x.name] = x.value;
                });

                $('.citizen-form-class').each(function () {
                    let form = $(this);
                    let data = {};

                    let inputs = form.serializeArray();
                    $.each(inputs, function (i, input) {
                        data[input.name] = input.value;
                    });

                    citizenData = {...citizenData, ...data};
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('citizens.store') }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        ...citizenData,
                    },
                    success: function (data) {
                        window.location.href = '{{ route('penduduk') }}';
                    },
                    error: function (response) {
                        $('input, select').removeClass('is-invalid');
                        console.log(response.responseJSON.message);
                        if (response.status === 400) {
                            const errors = response.responseJSON.message;
                            $('.invalid-feedback').text('');
                            for (const error in errors) {
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
        });
    </script>
@endpush