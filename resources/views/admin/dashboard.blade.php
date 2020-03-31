@extends('layouts.admin')

@section('content')
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

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="media white z-depth-1 rounded">
                    <i class="fas fa-chart-bar fa-lg teal z-depth-1 p-4 rounded-left text-white mr-3"></i>
                    <div class="media-body p-1">
                        <p class="text-uppercase text-muted mb-1"><small>{{ __('Applications') }}</small></p>
                        <h5 class="font-weight-bold mb-0">12 654</h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="media white z-depth-1 rounded">
                    <i class="fas fa-chart-pie fa-lg pink z-depth-1 p-4 rounded-left text-white mr-3"></i>
                    <div class="media-body p-1">
                        <p class="text-uppercase text-muted mb-1"><small>{{ __('Traffic') }}</small></p>
                        <h5 class="font-weight-bold mb-0">231 564</h5>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('No. offers') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                            @foreach( $latest_employers as $employer )
                                <tr>
                                    <td class="align-middle"><img class="img-fluid z-depth-1 rounded-circle" style="max-height: 48px"
                                             src="{{ $employer->getLogo() }}" alt=""></td>
                                    <td class="align-middle">{{ $employer->name }}</td>
                                    <td class="align-middle">{{ $employer->user()->first()->offers()->count() }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-end">
                                        <a class="btn-floating btn-danger"
                                           title="Remove this employer"
                                           href="#!"
                                           onclick="event.preventDefault();document.getElementById('delete-employer-{{$employer->id}}').submit();">
                                            <i class="fas fa-trash"></i>
                                            <form id="delete-employer-{{$employer->id}}"
                                                  action="{{ route('admin.destroy.employer', $employer) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </a>
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
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Employer') }}</th>
                                <th>{{ __('Created') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="table-hover">
                            @foreach( $latest_offers as $offer)
                                <tr>
                                    <td class="align-middle"><a href="/#/details/{{ $offer->id }}">{{ $offer->name }}</a></td>
                                    <td class="align-middle">{{ $offer->user()->first()->profile()->first()->name }}</td>
                                    <td class="align-middle">{{ $offer->created_at->diffForHumans() }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-end">
                                            <a class="btn-floating btn-default mr-2" title="Edit this offer"
                                               href="{{ route('offers.edit', $offer) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a class="btn-floating btn-danger" title="Remove this offer"
                                               href="#!"
                                               onclick="event.preventDefault();document.getElementById('delete-offer-{{$offer->id}}').submit();">
                                                <i class="fas fa-trash"></i>
                                                <form id="delete-offer-{{$offer->id}}"
                                                      action="{{ route('admin.destroy.offer', $offer) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </a>
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

