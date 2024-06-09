@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>{{ $breadcrumb }}</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if(\App\Helpers\SidebarHelper::hasAnyRole(['rw']))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-md-3 col-sm-6">
                                                <select class="form-control"
                                                        name="id_rt"
                                                        id="id_rt"
                                                        required>
                                                    <option value="{{null}}"
                                                            selected>Semua
                                                    </option>
                                                    @foreach ($rts as $rt)
                                                        <option value="{{ $rt->id_rt }}">{{ $rt->no_rt }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="form-text text-muted">Pilih Berdasarkan
                                                                                    RT</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div id="letter-archives"></div>
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
            RTFilter();
            let t = $('#letterArchives-table').DataTable();
            t.on('order.dt search.dt', function () {
                t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();

            $('#id_rt').change(function () {
                const id_rt = $(this).val() ?? null;
                RTFilter(id_rt);
            });

            function RTFilter(id_rt = null) {
                $.ajax({
                    url: "{{ route('letter-archives') }}",
                    type: "GET",
                    data: {id_rt: id_rt},
                    success: function (data) {
                        const $element = $('#letter-archives');
                        $element.html(data);
                    },
                    error: function (xhr) {
                        console.log("Error loading table:", xhr);
                    }
                });
            }
        });
    </script>
@endpush