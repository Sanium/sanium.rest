@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center full-height">
        <div class="card card-cascade narrower w-100" style="max-width: 650px;">
            <div class="view view-cascade gradient-card-header blue-gradient">
                <h2 class="card-header-title">{{ __('Sign up') }}</h2>
            </div>
            <div class="card-body card-body-cascade">
                <p class="small text-black-50">The fields marked with an asterisk (*) are required.</p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="md-form">
                        <input name="company-name" type="text" id="name" value="{{ old('company-name') }}"
                               class="form-control @error('company-name') is-invalid @enderror"
                               required autocomplete="company-name">
                        <label for="name" class="font-weight-light">{{ __('Company name') }}*</label>
                        @error('company-name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="md-form">
                        <input name="email" type="email" id="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               required autocomplete="email">
                        <label for="email" class="font-weight-light">{{ __('E-Mail') }}*</label>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="md-form">
                        <input name="password" type="password" id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required>
                        <label for="password" class="font-weight-light">{{ __('Password') }}*</label>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="font-small text-black-50 d-flex justify-content-center">
                            {{ __('At least 8 characters') }}
                        </div>
                    </div>
                    <div class="md-form">
                        <input name="password_confirmation" type="password" id="password_confirmation"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               required>
                        <label for="password_confirmation" class="font-weight-light">{{ __('Confirm password') }}*</label>
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="md-form form-row m0">
                        <div class="col-sm-12 col-md-6 p0 ">
                            <input name="company-size" type="text" id="company-size" value="{{ old('company-size') }}"
                                   class="form-control @error('company-size') is-invalid @enderror"
                                   required autocomplete="company-size">
                            <label for="company-size" class="font-weight-light">{{ __('Company size') }}*</label>
                            @error('company-size')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 p0">
                            <input name="company-website" type="text" id="company-website" value="{{ old('company-website') }}"
                                   class="form-control @error('company-website') is-invalid @enderror"
                                   required autocomplete="company-website">
                            <label for="company-website" class="font-weight-light">{{ __('Company website') }}*</label>
                            @error('company-website')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="md-form">
                        <button class="btn light-blue darken-2 text-white btn-block" type="submit">
                            {{ __('Sign up') }}
                        </button>
                        <p class="text-center">Already member? <a href="{{ route('login') }}">{{ __('Sign in') }}</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
