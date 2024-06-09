<div class="modal fade"
     tabindex="-1"
     role="dialog"
     id="updateUsername"
     style="display: none;"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-md"
         role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Username</h5>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('auth.update.username') }}"
                      method="POST">
                    {!! method_field('PUT') !!}
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="new_username">Username Baru</label>
                                <input type="text"
                                       class="form-control"
                                       id="new_username"
                                       name="new_username"
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