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
                            <form action="{{ \App\Helpers\SidebarHelper::hasAnyRole(['warga', 'rw', 'amil']) ? route('auth.update.username') : route('rt.update.ketuart')}}"
                                  method="POST">
                                <div class="row">
                                    @csrf
                                    {!! method_field('PUT') !!}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="{{ Auth()->user()->username }}"
                                                   id="username"
                                                   name="username"
                                                   disabled>
                                        </div>
                                    </div>
                                    @if(!\App\Helpers\SidebarHelper::hasAnyRole(['warga', 'rw', 'amil']))
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="new_ketuaRT">Ketua RT</label>
                                                <input type="text"
                                                       class="form-control"
                                                       value="{{ $rt->ketua_rt ?? "FAZA" }}"
                                                       id="new_ketuaRT"
                                                       name="new_ketuaRT">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="d-flex col-12 justify-content-end">
                                        <div class="btn-group">
                                            <button class="btn btn-primary ml-2"
                                                    id="submit-button">Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                            {!! method_field('PUT') !!}
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
    @if(\App\Helpers\SidebarHelper::hasAnyRole(['warga']))
        <x-modal.update-username-modal/>
    @endif
    @if(!\App\Helpers\SidebarHelper::hasAnyRole(['warga', 'rw', 'amil']))
        <x-modal.update-ketua-rt-modal/>
    @endif
@endsection