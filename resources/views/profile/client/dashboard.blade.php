@extends('layouts.app')
<?php
    /** @var App\Client $client */
?>
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
                            {{ $client->user->email }}
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
        <div class="card mt-5">
            <div class="card-body">
                <h5 class="card-title">{{ __('Your applications') }}</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Company') }}</th>
                        <th>{{ __('Date')}}</th>
                        <th></th>
                    </tr>
                    </thead>
                    @foreach($jors as $job)
                        <tbody>
                        <tr>
                            <td>
                                <a class="blue-text" href="/#/details/{{ $job->offer->id }}">
                                    {{ $job->offer->name }}</a>
                            </td>
                            <td>{{ $job->offer->user->profile->name }}</td>
                            <td>{{ $job->created_at->diffForHumans() }}</td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-danger px-3 m-0" title="@lang('Cancel your application')"
                                            onclick="event.preventDefault();document.getElementById('delete-jor-{{$job->id}}').submit();">
                                        <i class="fas fa-times" aria-hidden="true"></i>

                                    </button>
                                    <form id="delete-jor-{{$job->id}}"
                                          action="{{ route('jors.destroy', $job) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
                <div class="d-flex justify-content-center">
                    {{ $jors->links('components.pagination') }}
                </div>
            </div>

        </div>
    </div>
@endsection
