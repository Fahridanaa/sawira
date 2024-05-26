@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Surat</h1>
            <div class="btn-group">
                <button
                        class="btn btn-primary"
                        data-toggle="modal"
                        data-target="#letter-form-modal">Tambah Surat
                </button>
            </div>
        </div>
        <div class="section-body">
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
    <x-modal.letter-form-modal/>
@endsection
@push('js')
    {{ $dataTable->scripts() }}
    <script type="module">
        $(document).ready(function () {
            let t = $('#letter-table').DataTable();
            t.on('order.dt search.dt', function () {
                t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });
    </script>
@endpush