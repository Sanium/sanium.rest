@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center mt-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h5>{{ __('Verify Your Email Address') }}</h5>
                </div>
                <div>
                    <p>
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                    </p>
                    <p>
                        {{ __('If you did not receive the email') }}
                    </p>
                </div>
                <div>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn light-blue darken-2 text-white btn-block my-4">{{ __('click here to request another') }}</button>
                    </form>
                    @if (session('resent'))
                        <p class="text-muted text-center">{{ __('A fresh verification link has been sent to your email address.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
