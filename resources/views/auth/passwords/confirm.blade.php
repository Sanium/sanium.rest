@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2 l6 offset-l3 xl4 offset-xl4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">{{ __('Confirm Password') }}</span>
                        <div class="row">
                            {{ __('Please confirm your password before continuing.') }}
                        </div>
                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf
                            <div class="row">
                                <div class="col s12 input-field"></div>
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
                            <div class="row">
                                <div class="col s12 center-align row">
                                    <button class="col s12 btn waves-effect waves-light" type="submit"
                                            name="action">{{ __('Confirm Password') }}
                                        <i class="material-icons right">send</i>
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a
                                            href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
