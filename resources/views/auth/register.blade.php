@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 col-xl-4">
                <div class="card card-cascade narrower">
                    <div class="view view-cascade gradient-card-header blue-gradient">
                        <h2 class="card-header-title mb-3">{{ __('Register') }}</h2>
                    </div>
                    <div class="card-body card-body-cascade">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="md-form">
                                <i class="fa fa-user prefix grey-text"></i>
                                <input name="name" type="text" id="name"
                                       class="form-control mb-4 validate @error('name') invalid @enderror"
                                       required autocomplete="name" autofocus>
                                <label for="name" class="font-weight-light">{{ __('Name') }}</label>
                                @error('name')
                                <div class="valid-feedback red-text">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="md-form">
                                <i class="fa fa-envelope prefix grey-text"></i>
                                <input name="email" type="email" id="email"
                                       class="form-control mb-4 validate @error('email') invalid @enderror"
                                       required autocomplete="email" autofocus>
                                <label for="email" class="font-weight-light">{{ __('E-Mail') }}</label>
                                @error('email')
                                <div class="valid-feedback red-text">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="md-form">
                                <i class="fa fa-lock prefix grey-text"></i>
                                <input name="password" type="password" id="password"
                                       class="form-control mb-4 validate @error('password') invalid @enderror"
                                       required autocomplete="current-password">
                                <label for="password" class="font-weight-light">{{ __('Password') }}</label>
                                @error('password')
                                <div class="valid-feedback red-text">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="md-form">
                                <i class="fa fa-lock prefix grey-text"></i>
                                <input name="password" type="password" id="password"
                                       class="form-control mb-4 validate @error('password') invalid @enderror"
                                       required autocomplete="current-password">
                                <label for="password" class="font-weight-light">{{ __('Confirm Password') }}</label>
                                @error('password')
                                <div class="valid-feedback red-text">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button class="btn btn-primary btn-block my-4" type="submit">{{ __('Submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
