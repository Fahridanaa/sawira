@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kelola Data Penduduk</h1>
            <div class="section-header-button">
                <a href="#"
                   class="btn btn-primary">Add New</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Warga</h4>
                        </div>
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
@endsection
@push('css')
    <style>
        .card-header-form > form > .input-group > .input-group-btn > button {
            border-radius: 0 30px 30px 0 !important;
        }

        .card-header-form > form > .input-group > input {
            border-radius: 30px 0 0 30px !important;
        }

        table {
            width: 100% !important;
        }

        .section-header {
            justify-content: space-between;
        }
    </style>
@endpush
@push('js')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script type="module">
        $(document).ready(() => {
            $('#citizens-table').removeClass('table-bordered');
            $('#citizens-table_processing').empty();
        })
    </script>
@endpush