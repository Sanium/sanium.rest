@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2 l6 offset-l3 xl6 offset-xl3">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <span class="card-title">{{ __('Verify Your Email Address') }}</span>
                            <p>
                                {{ __('Before proceeding, please check your email for a verification link.') }}
                            </p>
                            <p>
                                {{ __('If you did not receive the email') }}
                            </p>
                        </div>
                        <div class="row center-align">
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit"
                                        class="col s12 btn waves-effect waves-light">{{ __('click here to request another') }}</button>
                            </form>

                            <p class="small">
                            @if ( session('resent'))
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                            @endif
                                &nbsp;
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
