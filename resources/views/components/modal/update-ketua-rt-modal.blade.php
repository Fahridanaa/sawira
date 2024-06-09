<div class="modal fade"
     tabindex="-1"
     role="dialog"
     id="updateKetuaRT"
     style="display: none;"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-md"
         role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Nama Ketua RT</h5>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('rt.update.ketuart') }}"
                      method="POST">
                    {!! method_field('PUT') !!}
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="new_ketuaRT">Nama Ketua RT Baru</label>
                                <input type="text"
                                       class="form-control"
                                       id="new_ketuaRT"
                                       name="new_ketuaRT"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <button type="submit"
                                class="btn btn-primary">Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>