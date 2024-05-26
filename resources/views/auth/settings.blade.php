@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pengaturan Akun</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td>{{ auth()->user()->username }}</td>
                                    <td class="d-flex justify-content-end">
                                        <button class="btn btn-primary detail-btn"
                                                data-toggle="modal"
                                                data-target="#updateUsername">Ubah
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Ubah Password</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('auth.update.password') }}"
                                  method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="old_password">Password Lama</label>
                                            <input type="password"
                                                   class="form-control"
                                                   id="old_password"
                                                   name="old_password"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="new_password">Password Baru</label>
                                            <input type="password"
                                                   class="form-control"
                                                   id="new_password"
                                                   name="new_password"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="confirm_password">Konfirmasi Password Baru</label>
                                            <input type="password"
                                                   class="form-control"
                                                   id="confirm_password"
                                                   name="confirm_password"
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit"
                                        class="btn btn-primary">Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
@endsection