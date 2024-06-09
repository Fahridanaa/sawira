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
                                    <td>{{ auth()->user()->username }}</td>
                                    @if(\App\Helpers\SidebarHelper::hasAnyRole(['warga']))
                                        <td class="d-flex justify-content-end">
                                            <button class="btn btn-primary detail-btn"
                                                    data-toggle="modal"
                                                    data-target="#updateUsername">Ubah
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                                @if(!\App\Helpers\SidebarHelper::hasAnyRole(['warga', 'rw', 'amil']))
                                    <tr>
                                        <td>Ketua RT</td>
                                        <td>{{ $rt->ketua_rt }}</td>
                                        <td class="d-flex justify-content-end">
                                            <button class="btn btn-primary detail-btn"
                                                    data-toggle="modal"
                                                    data-target="#updateKetuaRT">Ubah
                                            </button>
                                        </td>
                                    </tr>
                                @endif
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