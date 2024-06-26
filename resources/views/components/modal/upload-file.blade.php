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
                        <div class="custom-file">
                            <input type="file"
                                   name="file_surat"
                                   class="custom-file-input"
                                   id="file_surat">
                            <label class="custom-file-label"
                                   for="file_surat">Upload Surat Pengantar</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-danger"
                            id="">Cancel
                    </button>
                    <button type="submit"
                            class="btn btn-primary btn-shadow"
                            id="">Confirm
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('js')
    <script type="module">
        const uploadFileForm = $('#upload-file-modal form');
        const uploadFileModal = $('#upload-file-modal');
        const uploadFileButton = $('#upload-file-modal button[type="submit"]');

        $(document).on('click', '.upload-file-btn', function () {
            let urlParams = new URLSearchParams(window.location.search);
            let uploadFileUrl = (urlParams.get('activeTab') === 'citizens-history') ?
                "{{ route('citizens.upload', ['citizen' => '__id__']) }}" :
                "{{ route('family-heads.upload', ['family_head' => '__id__']) }}";
            let id = $(this).data('id');
            let url = uploadFileUrl.replace('__id__', id);
            uploadFileForm.attr('action', url);
        });

        uploadFileButton.on('click', function () {
            uploadFileForm.submit();
        });

        $('#file_surat').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });
    </script>
@endpush