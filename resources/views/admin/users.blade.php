@extends('layouts.admin')
<?php /** @var App\User $user */ ?>
@section('admin.content')
    <div class="container-fluid px-0">
        <section class="mx-0 mx-xl-5 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h4>{{ __('Users') }}</h4>
                    </div>
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('slug') }}</th>
                            <th>{{ __('E-mail') }}</th>
                            <th>{{ __('Created') }}</th>
                            <th>{{ __('Updated') }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $users as $user )
                            <tr>
                                <td class="align-middle">
                                    @if ( $user->isEmployer() )
                                    <img class="img-fluid z-depth-1 rounded-circle" style="max-height: 30px" src="{{ $user->profile->getLogo() }}" alt="">
                                    @endif
                                </td>
                                <td class="align-middle">{{ $user->name }}</td>
                                <td class="align-middle">{{ $user->profile->slug }}</td>
                                <td class="align-middle">
                                    <a class="light-blue-text text-darken-2" href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                </td>
                                <td class="align-middle">{{ $user->created_at->diffForHumans() }}</td>
                                <td class="align-middle">{{ $user->updated_at->diffForHumans() }}</td>
                                <td class="align-middle">
                                    @if ( $user->isEmployer() )
                                    <a class="light-blue-text text-darken-2" href="{{ route('admin.employers.offers', $user->profile) }}">see all offers</a>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if ( !$user->isAdmin() )
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-danger btn-sm m-0"
                                                title="Remove this employer"
                                                onclick="event.preventDefault();document.getElementById('delete-employer-{{$user->id}}').submit();">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form id="delete-employer-{{$user->id}}"
                                              action="{{ route('admin.users.destroy', $user) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $users->links('components.pagination') }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

