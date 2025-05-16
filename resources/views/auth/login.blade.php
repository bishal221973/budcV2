@extends('layouts.app')

@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <div class="main-login-container">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-7">
                <div class="w-100 bg-white border-0 login-border">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="w-100 login-description  p-3">
                                {{-- <b class="d-block text-white text-center">WELCOME TO</b> --}}
                                <div class="d-flex justify-content-center mt-5" style="margin-bottom: 50px">
                                    <img src="{{ asset('logo.png') }}" style="border-radius: 20px" />
                                </div>

                                <label class="d-block text-center" style="color:rgba(255, 255, 255, 0.8)"> <b> BASUKI
                                        Ultrasound and Diagnostic Center </b>
                                    Accurate, affordable imaging with care. Trusted diagnostics, timely reports, and
                                    patient-focused service.</label>

                                <div class="d-flex justify-content-center mt-5">
                                    <small style="color:rgba(255, 255, 255, 0.6)">© <span style="font-size:11px">Copyright
                                            GK IT Solution. All Rights Reserved</span> </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 py-4">
                            <b class="d-block text-center">USER LOGIN</b>
                            <small class="d-block text-center" style="color:rgba(0, 0, 0, 0.6)">Please enter email and
                                password</small>
                            <div class="pr-4">
                                <hr />
                            </div>

                            <div class="bg-white login-container p-3 py-3">

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="input-section mb-2">
                                        <i class="fa-solid fa-envelope"></i>
                                        <input type="email" name="email" placeholder="Email">
                                    </div>

                                    <div class="input-section">
                                        <i class="fa-solid fa-lock"></i>
                                        <input type="password" name="password" placeholder="Password">
                                    </div>

                                    <div class="d-flex mt-2">
                                        <label for="">
                                            <input type="checkbox" name="" id="">
                                            <span>Remember Me ?</span>
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-center mt-2">
                                        <button class="btn btn-info px-5">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
