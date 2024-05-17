@extends('layouts.auth')
@section('main')
    <div class="card card-primary">
        <div class="card-header justify-content-center pb-0">
            <h1 class="text-primary">
                <span style="border-bottom: 2px solid">Sa</span>wira
            </h1>
        </div>

        <div class="card-body">
            <form method="POST"
                  action="#"
                  class="needs-validation"
                  novalidate="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username"
                           type="text"
                           class="form-control"
                           placeholder="Masukkan Username"
                           name="username"
                           tabindex="1"
                           required
                           autofocus="">
                    <div class="invalid-feedback">
                        Please fill in your username
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password"
                               class="control-label">Password</label>
                    </div>
                    <input id="password"
                           type="password"
                           class="form-control"
                           placeholder="Masukkan Password"
                           name="password"
                           tabindex="2"
                           required>
                    <div class="invalid-feedback">
                        please fill in your password
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox"
                               name="remember"
                               class="custom-control-input"
                               tabindex="3"
                               id="remember-me">
                        <label class="custom-control-label"
                               for="remember-me">Remember Me</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit"
                            class="btn btn-primary btn-lg btn-block"
                            tabindex="4">
                        Login
                    </button>
                </div>
            </form>
            <div class="text-muted text-center">
                Tidak memiliki akun? <span class="text-primary">hubungi RT setempat</span>
            </div>
        </div>
    </div>
@endsection