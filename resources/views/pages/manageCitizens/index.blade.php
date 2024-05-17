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
                                               id="kk-tab"
                                               data-toggle="tab"
                                               href="#kk"
                                               role="tab"
                                               aria-controls="kk"
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
                                             id="kk"
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
        const tableIds = ['#citizens-table', '#family-head-table'];
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
            var activeTab = new URL(window.location.href).searchParams.get('activeTab');
            if (activeTab) {
                $('a[data-toggle="tab"][href="#' + activeTab + '"]').addClass('active show');
                $('#' + activeTab).addClass('active show').siblings().removeClass('active show');
                loadTabContent(activeTab);
            } else {
                $('a[data-toggle="tab"][href="#kk"]').click();
                // Default tab
                loadTabContent('kk');
            }

            function loadTabContent(tabId) {
                $.ajax({
                    url: '/tab-content/' + tabId,
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
        });
    </script>
@endpush