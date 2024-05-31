<div class="modal fade"
     tabindex="-1"
     role="dialog"
     id="upload-file-modal"
     style="display: none;"
     aria-hidden="true">
    <form method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-dialog modal-dialog-centered modal-md"
             role="document">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Upload File</h5>
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-0">
                        <label class="form-label">Upload Surat Pengantar</label>
                        <input type="file"
                               name="file_surat"
                               id="file_surat">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"
                            class="btn btn-danger btn-shadow"
                            id="">Yes
                    </button>
                    <button type="button"
                            class="btn btn-secondary"
                            id="">Cancel
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('js')
    <script type="module">
        const uploadFileUrl = "{{ route('family-heads.update', ['family_head' => '__id__']) }}";
        const uploadFileForm = $('#upload-file-modal form');
        const uploadFileModal = $('#upload-file-modal');
        const uploadFileButton = $('#upload-file-modal button[type="submit"]');

        $(document).on('click', '.upload-file-btn', function () {
            let id = $(this).data('id');
            let url = uploadFileUrl.replace('__id__', id);
            uploadFileForm.attr('action', url);
        });

        uploadFileButton.on('click', function () {
            uploadFileForm.submit();
        });
    </script>
@endpush