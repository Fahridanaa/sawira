@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Informasi Keluarga</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Kartu Keluarga</h2>
            <p class="section-lead"><span>No. KK: </span>{{ $no_kk }}</p>
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
    <x-modal.citizen-information/>
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
        });
    </script>
@endpush
