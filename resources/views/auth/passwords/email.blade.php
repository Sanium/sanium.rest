@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center mt-3">
        <div class="card w-100" style="max-width: 450px">
            <div class="card-body">
                <div class="card-title">
                    <h5>{{ __('Reset Password') }}</h5>
                </div>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="md-form">
                        <input name="email" id="email" type="email" class="form-control @error('email') invalid @enderror"
                                required autocomplete="email" autofocus>
                        <label for="email">{{ __('E-Mail Address') }}</label>

                        @error('email')
                        <span class="helper-text red-text" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <button class="btn light-blue darken-2 text-white btn-block my-4" type="submit"
                                name="action">{{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
