<div class="modal fade"
     tabindex="-1"
     role="dialog"
     id="delete-modal"
     style="display: none;"
     aria-hidden="true">
    <form method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-dialog modal-dialog-centered modal-md"
             role="document">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Apakah Anda Yakin?</h5>
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-0">
                        <label class="form-label">Pilih Status Riwayat</label>
                        <div class="selectgroup selectgroup-pills">
                            <label class="selectgroup-item w-100">
                                <input type="radio"
                                       name="status"
                                       value="Kematian"
                                       class="selectgroup-input"
                                       required>
                                <span class="selectgroup-button selectgroup-button-icon">Kematian</span>
                            </label>
                            <label class="selectgroup-item w-100">
                                <input type="radio"
                                       name="status"
                                       value="Pindah"
                                       class="selectgroup-input"
                                       required>
                                <span class="selectgroup-button selectgroup-button-icon">Pindah</span>
                            </label>
                            {{--                            <label class="selectgroup-item w-100">--}}
                            {{--                                <input type="radio"--}}
                            {{--                                       name="status"--}}
                            {{--                                       value="Lainnya"--}}
                            {{--                                       class="selectgroup-input"--}}
                            {{--                                       required>--}}
                            {{--                                <span class="selectgroup-button selectgroup-button-icon">Lainnya</span>--}}
                            {{--                            </label>--}}
                        </div>
                    </div>
                    <p>Data akan dimasukkan ke dalam riwayat</p>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            id="">Batal
                    </button>
                    <button type="submit"
                            class="btn btn-danger btn-shadow"
                            id="">Ya
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('js')
    <script type="module">
        const deleteForm = $('#delete-modal form');
        const deleteModal = $('#delete-modal');
        const deleteButton = $('#delete-modal button[type="submit"]');

        $(document).on('click', '.delete-btn', function () {
            let urlParams = new URLSearchParams(window.location.search);
            let deleteUrl = (urlParams.get('activeTab') === 'citizens') ?
                "{{ route('citizens.destroy', ['citizen' => '__id__']) }}" :
                "{{ route('family-heads.destroy', ['family_head' => '__id__']) }}";
            let id = $(this).parent().data('id');
            let url = deleteUrl.replace('__id__', id);
            deleteForm.attr('action', url);
        });

        deleteButton.on('click', function () {
            deleteForm.submit();
        });
    </script>
@endpush