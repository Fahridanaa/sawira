<div class="modal fade"
     tabindex="-1"
     role="dialog"
     id="detailModal"
     style="display: none;"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-md"
         role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Informasi</h5>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div id="nik"></div>
                        <div id="nama_lengkap"></div>
                        <div id="no_telp"></div>
                        <div id="ttl"></div>
                        <div id="agama"></div>
                        <div id="pendidikan"></div>
                        <div id="pekerjaan"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script type="module">
        $(document).on('click', '.detail-btn', function () {
            let id = $(this).data('id');
            $.ajax({
                url: '/details/' + id,
                success: function (data) {
                    $('#nik').html("<span class='font-weight-bolder'>NIK</span>&ensp;: " + data.nik);
                    $('#nama_lengkap').html("<span class='font-weight-bolder'>Nama Lengkap</span>&ensp;: " + data.nama_lengkap);
                    $('#no_telp').html("<span class='font-weight-bolder'>No Telp</span>&ensp;: " + data.no_telp);
                    $('#ttl').html("<span class='font-weight-bolder'>Tempat, dan Tanggal Lahir</span>&ensp;: " + data.asal_tempat + ", " + data.tanggal_lahir);
                    $('#agama').html("<span class='font-weight-bolder'>Agama</span>&ensp;: " + data.agama);
                    $('#pendidikan').html("<span class='font-weight-bolder'>Pendidikan Terakhir</span>&ensp;: " + data.pendidikan_terakhir);
                    $('#pekerjaan').html("<span class='font-weight-bolder'>Pekerjaan</span>&ensp;: " + data.pekerjaan);
                }
            });
        });
    </script>
@endpush