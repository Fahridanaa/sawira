@props([
	'familyInformation' => []
])

<div class="modal fade"
     tabindex="-1"
     role="dialog"
     id="family-condition-form-modal"
     style="display: none;"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"
         role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Kondisi Keluarga</h5>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="letter-form"
                  method="post"
                  action="{{ route('informasi-keluarga.update', ['informasi_keluarga' => $familyInformation['id_kondisi_keluarga']]) }}">
                @csrf
                {!! method_field('PUT') !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="jumlah_penghasilan">Penghasilan</label>
                                <input type="number"
                                       class="form-control"
                                       id="jumlah_penghasilan"
                                       name="jumlah_penghasilan"
                                       value="{{ $familyInformation['jumlah_penghasilan'] ?? '' }}"
                                       required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="jumlah_pengeluaran">Jumlah Pengeluaran</label>
                                <input type="number"
                                       class="form-control"
                                       id="jumlah_pengeluaran"
                                       name="jumlah_pengeluaran"
                                       value="{{ $familyInformation['jumlah_pengeluaran'] ?? '' }}"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="jumlah_hutang">Jumlah Hutang</label>
                                <input type="number"
                                       class="form-control"
                                       id="jumlah_hutang"
                                       name="jumlah_hutang"
                                       value="{{ $familyInformation['jumlah_hutang'] ?? '' }}"
                                       required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="jumlah_tanggungan">Jumlah Tanggungan</label>
                                <input type="number"
                                       class="form-control"
                                       id="jumlah_tanggungan"
                                       name="jumlah_tanggungan"
                                       value="{{ $familyInformation['jumlah_tanggungan'] ?? '' }}"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="id_kk">No. KK</label>
                                <select class="form-control"
                                        name="kondisi_tempat_tinggal"
                                        id="kondisi_tempat_tinggal"
                                        required>
                                    <option disabled
                                            hidden
                                            selected>Pilih Kondisi Tempat Tinggal
                                    </option>
                                    <option value="1"
                                            @if($familyInformation['kondisi_tempat_tinggal'] === 1) selected @endif>
                                        Sangat Layak (kondisi baik)
                                    </option>
                                    <option value="2"
                                            @if($familyInformation['kondisi_tempat_tinggal'] === 2) selected @endif>
                                        Layak (perlu sedikit perbaikan)
                                    </option>
                                    <option value="3"
                                            @if($familyInformation['kondisi_tempat_tinggal'] === 3) selected @endif>
                                        Cukup Layak (rusak ringan)
                                    </option>
                                    <option value="4"
                                            @if($familyInformation['kondisi_tempat_tinggal'] === 4) selected @endif>
                                        Tidak Layak (rusak sedang)
                                    </option>
                                    <option value="5"
                                            @if($familyInformation['kondisi_tempat_tinggal'] === 5) selected @endif>
                                        Sangat Tidak Layak (rusak berat)
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <div class="btn-group">
                                <button class="btn btn-danger"
                                        id="cancel-button">Cancel
                                </button>
                                <button class="btn btn-primary ml-2"
                                        id="submit-button">Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>