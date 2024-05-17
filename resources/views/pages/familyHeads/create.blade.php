@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Menambah Kartu Keluarga</h1>
            <div class="btn-group p-1">
                <button class="btn btn-danger mr-2">Batal</button>
                <button class="btn btn-primary ml-2">Simpan</button>
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
                            <form>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>No. KK</label>
                                            <input type="text"
                                                   class="form-control"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h4 style="font-size: 1rem">Alamat</h4>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Provinsi</label>
                                            <select class="form-control"
                                                    name="province"
                                                    id="province"
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
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kabupaten/Kota</label>
                                            <select class="form-control"
                                                    name="cities"
                                                    id="cities"
                                                    required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <select class="form-control"
                                                    name="districts"
                                                    id="districts"
                                                    required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Desa/Kelurahan</label>
                                            <select class="form-control"
                                                    name="villages"
                                                    id="villages"
                                                    required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kode Pos</label>
                                            <input type="text"
                                                   class="form-control"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text"
                                                   class="form-control"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <x-netizen.family-member-form id="headFamily"
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
            let i = 1;
            $("#add-member").click(function () {
                const newCard = `<x-netizen.family-member-form id="familyMember-${i}" status="familyMember" iteration="${i}"/>`;

                $(this).closest('.row').before(newCard);
                i += 1;
            });

            $("#delete-family-member-card").click(function () {
                const dataForm = $(this).data('form');
                $(`#familyMember-${dataForm}`).remove();
            });

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

            $('#province').on('change', function () {
                onChangeSelect('{{ route("cities") }}', $(this).val(), 'cities');
            });
            $('#cities').on('change', function () {
                onChangeSelect('{{ route("districts") }}', $(this).val(), 'districts');
            })
            $('#districts').on('change', function () {
                onChangeSelect('{{ route("villages") }}', $(this).val(), 'villages');
            })
        });
    </script>
@endpush