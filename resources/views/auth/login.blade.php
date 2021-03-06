@extends('layouts.auth')

@section('content')
    <section class="section-login">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-lg-4 text-center">
            <div class="figure">
              <img src="{{ url('/images/logo.svg') }}" class="figure-img img-fluid" alt="" />
              <h1>Selamat Datang</h1>
            </div>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-lg-4 text-center">
            <p>
              Silahkan masuk untuk belanja kebutuhan favorit anda dan keluarga
            </p>
          </div>
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="row mt-3 d-flex justify-content-center">
            <div class="col-12 col-lg-4">
                <label for="email" class="form-label">Alamat Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    aria-describedby="emailhelp"
                    autofocus
                />

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
            <div class="col-12 col-lg-4">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" name="password" class="form-control @error('passowrd') is-invalid @enderror " />

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Ingat saya') }}
                        </label>
                    </div>
                </div>
            </div>
            </div>
            <div class="row mt-4 d-flex justify-content-center">
            <div class="col-12 col-lg-4 mb-3">
                <div class="d-grid">
                <button type="submit" class="btn text-white btn-login">Masuk Sekarang</button>
                </div>
            </div>
            </div>
            <div class="row text-center">
            <div class="col-12 col-lg-12">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password">Lupa kata sandi?</a>
                @endif
            </div>
            </div>
        </form>
            <div class="row d-flex justify-content-center mt-4">
            <div class="col-12 col-lg-4 mb-3">
                <div class="d-grid text-center">
                <a href="{{ url('/auth/redirect') }}" class="btn img-fluid btn-login-google"
                    ><img src="{{ url('/images/ic_google.svg') }}" class="me-4" alt=""
                />Masuk dengan Google</a>
                </div>
            </div>
            </div>
            <div class="row d-flex justify-content-center mb-sm-3">
            <div class="col-12 col-lg-4 text-center already-account">
                <hr />
                <span
                >Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a></span
                >
            </div>
            </div>
      </div>
    </section>
@endsection
