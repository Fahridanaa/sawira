@props([
    'citizens' => [],
    'ttl' => '',
])
<div class="modal fade"
     tabindex="-1"
     role="dialog"
     id="letter-form-modal"
     style="display: none;"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"
         role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Surat</h5>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="letter-form"
                  method="post"
                  action="{{ route('letter.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="warga">Nama Lengkap</label>
                                <select name="warga"
                                        id="warga"
                                        class="form-control">
                                    @foreach($citizens as $citizen)
                                        <option disabled
                                                hidden
                                                selected>
                                            Pilih Anggota Keluarga
                                        </option>
                                        <option value="{{ $citizen->id_warga }}">
                                            {{ $citizen->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text"
                                       class="form-control datepicker"
                                       id="nik"
                                       readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="ttl">Tempat, Tanggal Lahir</label>
                                <input type="text"
                                       class="form-control datepicker"
                                       name="ttl"
                                       id="ttl"
                                       readonly>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <input type="text"
                                       class="form-control datepicker"
                                       name="agama"
                                       id="agama"
                                       readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input name="alamat"
                                       id="alamat"
                                       class="form-control"
                                       readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jenis_surat">Jenis Surat</label>
                                <select name="jenis_surat"
                                        id="jenis_surat"
                                        class="form-control">
                                    <option hidden
                                            disabled
                                            selected>Pilih Jenis Surat
                                    </option>
                                    <option value="1">Surat Keterangan Tidak Mampu</option>
                                    <option value="2">Surat Pengantar</option>
                                    <option value="3">Surat Pernyataan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row"
                         id="add-on-input">
                    </div>
                    <div class="row justify-content-end">
                        <div class="btn-group">
                            <button type="button"
                                    class="btn btn-secondary"
                                    data-dismiss="modal">Batal
                            </button>
                            <button type="button"
                                    class="btn btn-primary ml-3"
                                    id="add-btn">Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function () {
            function onChangeSelect(url, id) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $('#nik').val(data.nik);
                        $('#ttl').val(data.asal_tempat + ', ' + dateFormat(data.tanggal_lahir));
                        $('#agama').val(data.agama);
                        $('#alamat').val(data.alamat);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }

            function dateFormat(date) {
                const d = new Date(date);
                const dtf = new Intl.DateTimeFormat('id', {
                    year: 'numeric',
                    month: 'long',
                    day: '2-digit'
                });
                const [{value: day}, , {value: month}, , {value: year}] = dtf.formatToParts(d);
                return `${day} ${month} ${year}`;
            }

            $('#warga').on('change', function () {
                onChangeSelect('{{ route("citizens") }}', $(this).val());
            })

            $('#add-btn').on('click', function () {
                $('#letter-form').off('submit').submit();
                setTimeout(function () {
                    window.location.reload();
                }, 500);
            });

            $('#jenis_surat').on('change', function () {
                $('#add-on-input').empty();
                if ($(this).val() === '1' || $(this).val() === '3') {
                    $('#add-on-input').append(`@include('components.forms.letter.surat-pernyataan-form')`)
                } else if ($(this).val() === '2') {
                    $('#add-on-input').append(`@include('components.forms.letter.surat-pengantar')`)
                }
            })
        });
    </script>
@endpush