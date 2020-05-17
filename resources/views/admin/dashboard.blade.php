@extends('layouts.admin')
<?php
/** @var App\Employer $employer */
 /** @var App\Offer $offer */
?>
@section('admin.content')
    <div class="container-fluid px-0">
        <section class="row mx-0 mx-xl-5 mt-5">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="media white z-depth-1 rounded">
                    <i class="fas fa-users fa-lg blue z-depth-1 p-4 rounded-left text-white mr-3"></i>
                    <div class="media-body p-1">
                        <p class="text-uppercase text-muted mb-1"><small>{{ __('Total users') }}</small></p>
                        <h5 class="font-weight-bold mb-0">{{ $user_count }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="media white z-depth-1 rounded">
                    <i class="fas fa-receipt fa-lg deep-purple z-depth-1 p-4 rounded-left text-white mr-3"></i>
                    <div class="media-body p-1">
                        <p class="text-uppercase text-muted mb-1"><small>{{ __('Total offers') }}</small></p>
                        <h5 class="font-weight-bold mb-0">{{ $offer_count }}</h5>
                    </div>
                </div>
            </div>
        </section>

        <section class="row mx-0 mx-xl-5 mt-5">
            <div class="col-12 col-xl-5 pb-4 pb-xl-0">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <h4>{{ __('Last new users') }}</h4>
                        </div>
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th></th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Size') }}</th>
                                <th>{{ __('Website') }}</th>
                                <th>{{ __('Created') }}</th>
                                <th>{{ __('Total offers') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $latest_employers as $employer )
                                <tr>
                                    <td class="align-middle">
                                        <img class="img-fluid z-depth-1 rounded-circle" style="max-height: 30px"
                                             src="{{ $employer->getLogo() }}" alt="">
                                    </td>
                                    <td class="align-middle">
                                        <a class="light-blue-text text-darken-2" href="{{ route('admin.employers.show', $employer) }}">
                                            {{ $employer->name }}
                                        </a>
                                    </td>
                                    <td class="align-middle">{{ $employer->size }}</td>
                                    <td class="align-middle">
                                        <a class="light-blue-text text-darken-2" href="{{ $employer->website }}">
                                            {{ $employer->website }}
                                        </a>
                                    </td>
                                    <td class="align-middle">{{ $employer->created_at->diffForHumans() }}</td>
                                    <td class="align-middle">
                                        <a class="light-blue-text text-darken-2" title="see all offers"
                                           href="{{ route('admin.employers.offers', $employer) }}">
                                            {{ $employer->user()->first()->offers()->count() }}
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-danger btn-sm m-0"
                                                    title="Remove this employer"
                                                    onclick="event.preventDefault();document.getElementById('delete-employer-{{$employer->id}}').submit();">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <form id="delete-employer-{{$employer->id}}"
                                                  action="{{ route('admin.users.destroy', $employer->user) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-7">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <h4>{{ __('Last new offers') }}</h4>
                        </div>
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Employer') }}</th>
                                <th>{{ __('Created') }}</th>
                                <th>{{ __('Updated') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="table-hover">
                            @foreach( $latest_offers as $offer)
                                <tr>
                                    <td class="align-middle">
                                        <a class="light-blue-text text-darken-2" href="/#/details/{{ $offer->id }}">
                                            {{ $offer->name }}
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('admin.employers.show', $offer->user()->first()->profile()->first()) }}" class="light-blue-text text-darken-2">
                                            {{ $offer->user->profile->name }}
                                        </a>
                                    </td>
                                    <td class="align-middle">{{ $offer->created_at->diffForHumans() }}</td>
                                    <td class="align-middle">{{ $offer->updated_at->diffForHumans() }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-danger btn-sm m-0" title="Remove this offer"
                                                    onclick="event.preventDefault();document.getElementById('delete-offer-{{$offer->id}}').submit();">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <form id="delete-offer-{{$offer->id}}"
                                                  action="{{ route('admin.destroy.offer', $offer) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

