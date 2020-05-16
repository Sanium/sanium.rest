@extends('layouts.app')

@section('title')
    Dashboard - @parent
@endsection

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <div class="row d-flex align-items-center">
                    <div class="col d-flex flex-column">
                        <p class="text-muted mb-1 font-weight-light">@lang('Hello!')</p>
                        <p class="h4 font-weight-normal">{{ $client->name }}</p>
                    </div>
                    <div class="col d-flex flex-column">
                        <p class="text-muted mb-1 font-weight-light">Email</p>
                        <p class="h5 font-weight-normal">
                            {{ auth()->user()->email }}
                        </p>
                    </div>
                    <div class="col d-flex flex-column">
                        <p class="text-muted mb-1 font-weight-light">Links</p>
                        <p class="h5 font-weight-normal">
                            <i class="fab fa-github">
                                <a href="{{ $client->links }}">{{ $client->links }}</a>
                            </i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
