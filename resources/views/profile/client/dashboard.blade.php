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
            <div class="card-body row d-flex align-items-center">
                <div class="col-12 col-sm-7 d-flex flex-column">
                    <p class="text-muted mb-1 font-weight-light">@lang('Hello!')</p>
                    <p class="h4 font-weight-normal">{{ $client->name }}</p>
                </div>
                <div class="col-12 col-sm-5 d-flex flex-column">
                    <p class="text-muted mb-1 font-weight-light">Email</p>
                    <p class="h5 font-weight-normal">
                        <a href="mailto:{{ $client->user->email }}">{{ $client->user->email }}</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-body">
                <div class="card-title d-flex justify-content-between align-items-center">
                    <h4>@lang('Your applications')</h4>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Company') }}</th>
                        <th>{{ __('Date')}}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($jors as $job)
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
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="text-center m-4">
                                    <p><i class="fas fa-box-open fa-6x"></i></p>
                                    <h4 class="mb-3">@lang('A bit empty here...') </h4>
                                    <a class="btn btn-amber" href="{{ route('welcome') }}">@lang('Find new job')</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $jors->links('components.pagination') }}
                </div>
            </div>

        </div>
    </div>
@endsection
