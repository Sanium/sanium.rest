@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2 l6 offset-l3 xl4 offset-xl4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center-align">{{ __('Login') }}</span>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">mail</i>
                                    <input id="email" type="email" class="validate @error('email') invalid @enderror"
                                           name="email" required autocomplete="email" autofocus>
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 input-field">
                                    <i class="material-icons prefix">lock</i>
                                    <input id="password" type="password"
                                           class="validate @error('password') invalid @enderror" name="password"
                                           required autocomplete="current-password">
                                    <label for="password">{{ __('Password') }}</label>

                                    @if ($errors->any())
                                        <span class="red-text" role="alert">
                                            @foreach($errors->all() as $error) {{ $error }} @endforeach
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6">
                                    <label>
                                        <input name="remember" id="remember" type="checkbox"
                                               class="filled-in" {{ old('remember') ? 'checked' : '' }}>
                                        <span>{{ __('Remember Me') }}</span>
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <div class="col s6 right-align">
                                        <a href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }}</a>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col s12 center-align row">
                                    <button class="col s12 btn waves-effect waves-light" type="submit"
                                            name="action">{{ __('Login') }}
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
