@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center full-height" >
        <div class="card card-cascade narrower w-100" style="max-width: 450px;">
            <div class="view view-cascade gradient-card-header blue-gradient">
                <h2 class="card-header-title mb-0">{{ __('Sign in') }}</h2>
            </div>
            <div class="card-body card-body-cascade">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="md-form">
                        <input name="email" type="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               required autocomplete="email" autofocus>
                        <label for="email" class="font-weight-light">{{ __('E-Mail') }}</label>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="md-form">
                        <input name="password" type="password" id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required autocomplete="current-password">
                        <label for="password" class="font-weight-light">{{ __('Password') }}</label>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        @if (Route::has('password.request'))
                            <div class="font-small d-flex justify-content-end">
                                <a href="{{ route('password.request') }}"> {{ __('Forgot password?') }}</a>
                            </div>
                        @endif
                    </div>
                    <div class="d-flex text-black-50">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input"
                                   name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label"
                                   for="remember">{{ __('Remember Me') }}</label>
                        </div>
                    </div>
                    <div class="md-form">
                        <button class="btn light-blue darken-2 text-white btn-block my-4"
                                type="submit">{{ __('Sign in') }}</button>
                        <p class="text-center">{{ __('Not a member?') }} <a href="{{ route('register') }}">{{ __('Sign up') }}</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
