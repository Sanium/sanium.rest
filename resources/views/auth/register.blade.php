@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="center-align">
            <div class="col m12">
                <div class="card">
                    <h4>{{ __('Register') }}</h4>
                    <div class="card-content">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="input-field">
                                    <input id="name" type="text" class="validate @error('name') invalid @enderror" name="name" required>
                                    <label for="name">{{ __('Name') }}</label>

                                    @error('name')
                                    <span class="helper-text red-text" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field">
                                    <input id="email" type="email" class="validate @error('email') invalid @enderror" name="email" required autocomplete="email" autofocus>
                                    <label for="email">{{ __('E-Mail Address') }}</label>

                                    @error('email')
                                    <span class="helper-text red-text" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field">
                                    <input id="password" type="password" class="validate @error('password') invalid @enderror" name="password" required>
                                    <label for="password">{{ __('Password') }}</label>

                                    @error('password')
                                    <span class="helper-text red-text" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field">
                                    <input id="confirm-password" type="password" class="validate" name="password_confirmation" required>
                                    <label for="confirm-password">{{ __('Confirm Password') }}</label>
                                </div>
                            </div>

                            <button class="btn waves-effect waves-light" type="submit" name="action">Register
                                <i class="material-icons right">send</i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
