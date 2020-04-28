@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center mt-3">
        <div class="card">
            <div class="card-body">
                <div>
                    <h5 class="card-title">{{ __('Confirm Password') }}</h5>
                </div>
                <div>
                    {{ __('Please confirm your password before continuing.') }}
                </div>
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <div>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="current-password">
                        <label for="password">{{ __('Password') }}</label>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <button class="btn light-blue darken-2 text-white btn-block my-4" type="submit"
                                name="action">{{ __('Confirm Password') }}
                        </button>
                        @if (Route::has('password.request'))
                            <a
                                href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
