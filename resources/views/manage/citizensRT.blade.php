@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-success d-flex justify-content-between">
                    <div class="title">
                        <h4 class="card-title ">Kelola Warga</h4>
                        <p class="card-category">RT 1</p>
                    </div>
                    <div class="btn-group">
                        <a href="#"
                           class="btn btn-sm btn-primary">Tambah Warga</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    @php--}}
    {{--        use App\Models\KKModel;--}}
    {{--            $kk = KKModel::with('akun')->find('128  ');--}}
    {{--            dd($kk->akun);--}}
    {{--    @endphp--}}
@endsection
@push('css')
    <style>
        .table > thead > tr > th {
            font-weight: 400 !important;
        }
    </style>
@endpush
@push('js')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script type="module">
        $(document).ready(() => {
            $('#citizens-table').removeClass('dataTable table-bordered');
        })
    </script>
@endpush