@extends('layouts.app')

@section('title')
    Dashboard - @parent
@endsection

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-body row d-flex align-items-center">
                <div class="col-12 col-sm-6  d-flex flex-column">
                    <p class="text-muted mb-1 font-weight-light">@lang('Hello!')</p>
                    <p class="h4 font-weight-normal">{{ $client->name }}</p>
                </div>
                <div class="col-12 col-sm-6">
                    <a href="{{ route('client.edit', $client) }}">Edycja</a>
                </div>
            </div>
        </div>
    </div>
@endsection
