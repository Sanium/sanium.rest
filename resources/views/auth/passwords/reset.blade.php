@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center mt-3">
        <div class="card w-100" style="max-width: 300px">
            <div class="card-body">
                <div class="card-title">
                    <h5>{{ __('Reset Password') }}</h5>
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="md-form">
                        <input id="email" type="email" class="form-control @error('email') invalid @enderror"
                               name="email" required autocomplete="email" autofocus>
                        <label for="email">{{ __('E-Mail Address') }}</label>

                        @error('email')
                        <span class="helper-text red-text" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="md-form">
                        <input id="password" type="password"
                               class="form-control @error('password') invalid @enderror" name="password" required>
                        <label for="password">{{ __('Password') }}</label>

                        @error('password')
                        <span class="helper-text red-text" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="md-form">
                        <input id="confirm-password" type="password" class="form-control" name="password_confirmation"
                               required>
                        <label for="confirm-password">{{ __('Confirm Password') }}</label>
                    </div>
                    <div>
                        <button class="btn light-blue darken-2 text-white btn-block my-4" type="submit">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
