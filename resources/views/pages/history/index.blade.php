@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Riwayat Penduduk</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-4 col-xl-2">
                                    <ul class="nav nav-pills flex-column"
                                        id="myTab4"
                                        role="tablist">
                                        <li class="nav-item mb-1">
                                            <a class="nav-link"
                                               id="family-history-tab"
                                               data-toggle="tab"
                                               href="#family-history"
                                               role="tab"
                                               aria-controls="family-history"
                                               aria-selected="true">Keluarga</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                               id="citizens-history-tab"
                                               data-toggle="tab"
                                               href="#citizens-history"
                                               role="tab"
                                               aria-controls="citizens-history"
                                               aria-selected="false">Warga</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-xl-10">
                                    <div class="tab-content no-padding"
                                         id="myTab2Content">
                                        @if(\App\Helpers\SidebarHelper::hasAnyRole(['rw']))
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-1 control-label col-form-label">Filter:</label>
                                                        <div class="col-3">
                                                            <select class="form-control"
                                                                    name="id_rt"
                                                                    id="id_rt"
                                                                    required>
                                                                <option disabled
                                                                        hidden
                                                                        selected>- RT -
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
                                        <div class="tab-pane fade"
                                             id="family-history"
                                             role="tabpanel"
                                             aria-labelledby="kk-tab">
                                        </div>

                                        <div class="tab-pane fade"
                                             id="citizens-history"
                                             role="tabpanel"
                                             aria-labelledby="citizens-tab">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-modal.upload-file/>
@endsection
@push('css')
    <style>
        .card-header-form > form > .input-group > .input-group-btn > button {
            border-radius: 0 30px 30px 0 !important;
        }

        .card-header-form > form > .input-group > input {
            border-radius: 30px 0 0 30px !important;
        }

        .section-header {
            justify-content: space-between;
        }

        .dt-buttons {
            float: right;
        }
    </style>
@endpush
@push('js')
    <script type="module">
        const tableIds = ['#citizens-history-table', '#family-history-table'];
        $(document).ready(() => {
            $('#citizens-history-table').removeClass('table-bordered');
            $('#citizens-history-table_processing').empty();

            $('a[data-toggle="tab"]').on('click', function (e) {
                e.preventDefault();
                const target = $(this).attr("href");
                const tabId = target.substring(1);

                var url = new URL(window.location.href);
                url.searchParams.set('activeTab', tabId);
                window.history.pushState({}, '', url);

                // Remove active and show classes from other tabs
                $(target).addClass("active show").siblings().removeClass("active show");
                $('a[data-toggle="tab"]').removeClass('active show');
                $(this).addClass('active show');

                // Load content dynamically
                loadTabContent(tabId);
            });

            // Load content based on URL parameter on page load
            function setActiveTabAndUpdateContent(tabName) {
                $('a[data-toggle="tab"][href="#' + tabName + '"]').addClass('active show');
                $('#' + tabName).addClass('active show').siblings().removeClass('active show');
                loadTabContent(tabName);
            }

            const activeTab = new URL(window.location.href).searchParams.get('activeTab');
            if (activeTab) {
                setActiveTabAndUpdateContent(activeTab);
            } else {
                setActiveTabAndUpdateContent('family-history'); // Default tab
            }

            function loadTabContent(tabId) {

                const urlBase = '/tab-content/';

                const url = urlBase + tabId;

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
                        $('#' + tabId).html(response);
                        if (!$.fn.DataTable.isDataTable('#' + tabId + ' table')) {
                            $('#' + tabId + ' table').DataTable();
                        }

                        destroyTable(tableIds);
                    },
                    error: function (xhr) {
                        console.log("Error loading tab content:", xhr);
                    }
                });
            }

            function destroyTable(tableIds) {
                tableIds.forEach(function (id) {
                    if ($.fn.dataTable.isDataTable(id)) {
                        $(id).DataTable().destroy();
                    }
                });
            }

            $('#id_rt').change(function () {
                var id_rt = $(this).val();
                if (id_rt) {
                    $.ajax({
                        url: "{{ route('citizens-history.index') }}", // Menggunakan route yang tepat
                        type: "GET",
                        data: {id_rt: id_rt},
                        success: function (data) {
                            $('#citizens-history').html(data);
                        },
                        error: function (xhr) {
                            console.log("Error loading table:", xhr);
                        }
                    });

                    $.ajax({
                        url: "{{ route('family-history.index') }}",
                        type: "GET",
                        data: {id_rt: id_rt},
                        success: function (data) {
                            $('#family-history').html(data);
                        },
                        error: function (xhr) {
                            console.log("Error loading family heads table:", xhr);
                        }
                    });
                } else {
                    $('#citizens-history').html(''); // Kosongkan tabel jika tidak ada RT yang dipilih
                    $('#family-history').html(''); // Kosongkan tabel Family Heads jika tidak ada RT yang dipilih
                }
            });
        });
    </script>
@endpush