@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kelola Data Penduduk</h1>
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
                                               id="family-heads-tab"
                                               data-toggle="tab"
                                               href="#family-heads"
                                               role="tab"
                                               aria-controls="family-heads"
                                               aria-selected="true">Keluarga</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                               id="citizens-tab"
                                               data-toggle="tab"
                                               href="#citizens"
                                               role="tab"
                                               aria-controls="citizens"
                                               aria-selected="false">Warga</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-xl-10">
                                    <div class="tab-content no-padding"
                                         id="myTab2Content">
                                        <div class="tab-pane fade"
                                             id="family-heads"
                                             role="tabpanel"
                                             aria-labelledby="kk-tab">
                                        </div>

                                        <div class="tab-pane fade"
                                             id="citizens"
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
    {{--    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>--}}
    <script type="module">
        const tableIds = ['#citizens-table', '#family-heads-table'];
        $(document).ready(() => {
            $('#citizens-table').removeClass('table-bordered');
            $('#citizens-table_processing').empty();

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
                setActiveTabAndUpdateContent('family-heads');
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

            $(document).on('click', '.detail-btn', function () {
                let id = $(this).data('id');
                $.ajax({
                    url: '/details/' + id,
                    success: function (data) {
                        $('#nik').html("<span class='font-weight-bolder'>NIK</span>&ensp;: " + data.nik);
                        $('#nama_lengkap').html("<span class='font-weight-bolder'>Nama Lengkap</span>&ensp;: " + data.nama_lengkap);
                        $('#no_telp').html("<span class='font-weight-bolder'>No Telp</span>&ensp;: " + data.no_telp);
                        $('#ttl').html("<span class='font-weight-bolder'>Tempat, dan Tanggal Lahir</span>&ensp;: " + data.asal_kota + ", " + data.tanggal_lahir);
                        $('#agama').html("<span class='font-weight-bolder'>Agama</span>&ensp;: " + data.agama);
                        $('#pendidikan').html("<span class='font-weight-bolder'>Pendidikan Terakhir</span>&ensp;: " + data.pendidikan_terakhir);
                        $('#pekerjaan').html("<span class='font-weight-bolder'>Pekerjaan</span>&ensp;: " + data.jenis_pekerjaan);
                    }
                });
            });
        });
    </script>
@endpush