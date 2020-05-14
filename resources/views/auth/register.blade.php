@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center full-height">
        <div class="card card-cascade narrower w-100" style="max-width: 650px;">
            <div class="view view-cascade gradient-card-header blue-gradient">
                <h2 class="card-header-title mb-0">{{ __('Sign up') }}</h2>
                <ul class="nav nav-tabs nav-justified md-tabs mt-2 text-white bg-transparent"
                    style="-webkit-box-shadow: none" id="myTabJust" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab-just" data-toggle="tab" href="#user" role="tab"
                           aria-controls="home-just"
                           aria-selected="true"><i class="fas fa-user pr-2"></i>{{ __('User') }}</a></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab-just" data-toggle="tab" href="#company" role="tab"
                           aria-controls="profile-just"
                           aria-selected="false"><i class="fas fa-building pr-2"></i>{{ __('Company') }}</a></a>
                    </li>
                </ul>
            </div>
            <div class="card-body card-body-cascade">
                <div class="tab-content" style="padding-top: 0rem">
                    <div class="tab-pane fade active show" id="user" role="tabpanel">
                        <form method="POST" action="{{ route('register.client') }}">
                            @csrf
                            <div class="md-form">
                                <input name="name" type="text" id="name" value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       required autocomplete="name">
                                <label for="name" class="font-weight-light">{{ __('Full name') }}*</label>
                                @error('name')
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
                                    {{ __('At least 8 characters.') }}
                                </div>
                            </div>
                            <div class="md-form">
                                <input name="password_confirmation" type="password" id="password_confirmation"
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       required>
                                <label for="password_confirmation"
                                       class="font-weight-light">{{ __('Confirm Password') }}*</label>
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="md-form">
                                <input name="links" type="text" id="links" value="{{ old('links') }}"
                                       class="form-control @error('links') is-invalid @enderror"
                                       required autocomplete="links">
                                <label for="links" class="font-weight-light">{{ __('Github, LinkedIn etc.') }}*</label>
                                @error('links')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="md-form">
                                <div class="file-field">
                                    <div class="btn light-blue darken-2 text-white btn-sm float-left">
                                        <span><i class="fas fa-upload mr-2" aria-hidden="true"></i>{{ __('Choose file') }}</span>
                                        <input name="file" id="file" type="file" accept=".pdf">
                                        @error('file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text"
                                               placeholder="{{ __('Upload your CV') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="md-form">
                                <button class="btn light-blue darken-2 text-white btn-block" type="submit">
                                    {{ __('Sign up') }}
                                </button>
                                <p class="text-center">{{ __('Already member?') }} <a
                                        href="{{ route('login') }}">{{ __('Sign in') }}</a></p>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="company" role="tabpanel">
                        <form method="POST" action="{{ route('register.employer') }}">
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
                                    {{ __('At least 8 characters.') }}
                                </div>
                            </div>
                            <div class="md-form">
                                <input name="password_confirmation" type="password" id="password_confirmation"
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       required>
                                <label for="password_confirmation"
                                       class="font-weight-light">{{ __('Confirm Password') }}*</label>
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="md-form">

                                <input name="company-size" type="text" id="company-size"
                                       value="{{ old('company-size') }}"
                                       class="form-control @error('company-size') is-invalid @enderror"
                                       required autocomplete="company-size">
                                <label for="company-size" class="font-weight-light">{{ __('Company size') }}
                                    *</label>
                                @error('company-size')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="md-form">
                                <input name="company-website" type="text" id="company-website"
                                       value="{{ old('company-website') }}"
                                       class="form-control @error('company-website') is-invalid @enderror"
                                       required autocomplete="company-website">
                                <label for="company-website" class="font-weight-light">{{ __('Company website') }}
                                    *</label>
                                @error('company-website')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="md-form">
                                <button class="btn light-blue darken-2 text-white btn-block" type="submit">
                                    {{ __('Sign up') }}
                                </button>
                                <p class="text-center">{{ __('Already member?') }} <a
                                        href="{{ route('login') }}">{{ __('Sign in') }}</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
