@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Informasi Keluarga</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Kartu Keluarga</h2>
            <p class="section-lead"><span>No. KK: </span>169463869098143</p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade"
         tabindex="-1"
         role="dialog"
         id="fire-modal-2"
         style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Modal Title</h5>
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body"> Modal body text goes here.</div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    {{ $dataTable->scripts() }}
    <script type="module">
        $(document).ready(function () {
            let t = $('#kartukeluarga-table').DataTable();
            t.on('order.dt search.dt', function () {
                t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            // $("#modal-2").click((e) => {
            //     e.stopPropagation();
            //     $('body').classList.add('modal-open');
            // });
        });
    </script>
@endpush
