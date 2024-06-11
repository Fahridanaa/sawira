@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pembagian Zakat</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-12 d-flex justify-content-end">
                                    <form action="{{ route('zakat.store') }}"
                                          method="POST">
                                        @csrf
                                        <div class="btn-group">
                                            <button type="submit"
                                            class="btn btn-primary">Hitung
                                            </button>
                                        <a href="{{ route('saw.export.pdf') }}" class="btn btn-danger">SAW PDF</a>
                                        <a href="{{ route('smart.export.pdf') }}" class="btn btn-danger">SMART PDF</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <ul class="nav nav-tabs"
                                id="myTab"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show"
                                       id="saw-tab"
                                       data-toggle="tab"
                                       href="#saw"
                                       role="tab"
                                       aria-controls="profile"
                                       aria-selected="true">SAW</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       id="smart-tab"
                                       data-toggle="tab"
                                       href="#smart"
                                       role="tab"
                                       aria-controls="home"
                                       aria-selected="false">SMART</a>
                                </li>
                            </ul>
                            <div class="tab-content"
                                 id="myTabContent">
                                <div class="tab-pane fade"
                                     id="saw"
                                     role="tabpanel"
                                     aria-labelledby="saw-tab">
                                </div>
                                <div class="tab-pane fade"
                                     id="smart"
                                     role="tabpanel"
                                     aria-labelledby="smart-tab">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script type="module">
        $(document).ready(() => {
            const tableIds = ['#saw-table', '#smart-table'];

            $('a[data-toggle="tab"]').on('click', function (e) {
                e.preventDefault();
                const target = $(this).attr("href");
                const tabId = target.substring(1);

                var url = new URL(window.location.href);
                url.searchParams.set('activeTab', tabId);
                window.history.pushState({}, '', url);

                $(target).addClass("active show").siblings().removeClass("active show");
                $('a[data-toggle="tab"]').removeClass('active show');
                $(this).addClass('active show');

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
                setActiveTabAndUpdateContent('saw');
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
        });
    </script>
@endpush