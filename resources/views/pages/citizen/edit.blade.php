@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Edit Data Warga</h1>
            <div class="btn-group">
                <a href="{{ route('penduduk') }}">
                    <button class="btn btn-danger mr-2">
                        Batal
                    </button>
                </a>
                <button class="btn btn-primary ml-2"
                        id="submit-button">Simpan
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
                            <form id="no-kk-form"
                                  method="POST">
                                @csrf
                                {{ method_field('PUT') }}
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
                                                    <option value="{{ $no_kk->id_kk }}"
                                                            @if($citizen->id_kk === $no_kk->id_kk) selected @endif>
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
                    <div class="card">
                        <div class="card-body">
                            <x-forms.family-member-form
                                    :citizen="$citizen"
                                    id="familyMember-0"
                                    status="{{ ($citizen->id_hubungan) ? 'headFamily' : 'familyMember' }}"
                                    state="edit"
                            />
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
            const headFamilyRecords = JSON.parse('{!! $headFamilyRecords !!}');

            function setHeadFamilyName() {
                const selectedId = $('#id_kk').val();
                const headFamilyName = headFamilyRecords[selectedId];
                $('#kepala_keluarga').val(headFamilyName);
            }

            setHeadFamilyName();
            $('#id_kk').change(setHeadFamilyName);

            $('#submit-button').click(function (e) {
                e.preventDefault();
                const kkForm = $('#no-kk-form');
                const familyMemberForm = $('form#familyMember-0');
                const mergedData = $.extend(kkForm.serializeArray(), familyMemberForm.serializeArray());
                const requestData = mergedData.reduce(function (obj, item) {
                    obj[item.name] = item.value;
                    return obj;
                }, {});
                requestData.id_kk = $('#id_kk').val();

                // Send the merged data
                $.ajax({
                    type: 'POST',
                    url: '{{ route('citizens.update', $citizen->id_warga) }}',
                    data: requestData,
                    success: function () {
                        window.location.href = '{{ route('penduduk') }}';
                    },
                    error: function (response) {
                        const errors = response.responseJSON.message;
                        for (const [inputName, errorMessage] of Object.entries(errors)) {
                            let $input = familyMemberForm.find(`input[name=${inputName}], select[name=${inputName}]`);
                            $input.addClass('is-invalid');
                            $input.siblings('.invalid-feedback').text(errorMessage[0]);
                        }
                    }
                });
            });
        });
    </script>
@endpush