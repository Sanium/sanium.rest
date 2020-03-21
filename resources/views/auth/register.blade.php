@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2 l6 offset-l3 xl4 offset-xl4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center-align">{{ __('Register') }}</span>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">person</i>
                                    <input id="name" type="text" class="validate @error('name') invalid @enderror"
                                           name="name" required>
                                    <label for="name">{{ __('Name') }}</label>

                                    @error('name')
                                    <span class="helper-text red-text" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">mail</i>
                                    <input id="email" type="email" class="validate @error('email') invalid @enderror"
                                           name="email" required autocomplete="email" autofocus>
                                    <label for="email">{{ __('E-Mail Address') }}</label>

                                    @error('email')
                                    <span class="helper-text red-text" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">lock</i>
                                    <input id="password" type="password"
                                           class="validate @error('password') invalid @enderror" name="password"
                                           required>
                                    <label for="password">{{ __('Password') }}</label>

                                    @error('password')
                                    <span class="helper-text red-text" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">lock</i>
                                    <input id="confirm-password" type="password" class="validate"
                                           name="password_confirmation" required>
                                    <label for="confirm-password">{{ __('Confirm Password') }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 center-align row">
                                    <button class="col s12 btn waves-effect waves-light" type="submit"
                                            name="action">{{ __('Register') }}
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
