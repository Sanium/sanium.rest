@extends('layouts.app')

@section('title')
    Dashboard - @parent
@endsection

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-body row d-flex align-items-center">
                <div class="col-12 col-sm-2 d-flex justify-content-center">
                    <img src="{{ $employer->getLogo() }}" class="img-fluid z-depth-1 rounded-circle"
                         alt="Responsive image" style="max-height: 95px">
                </div>
                <div class="col-12 col-sm-10 col-lg-4 d-flex flex-column">
                    <p class="text-muted mb-1 font-weight-light">@lang('Hello!')</p>
                    <p class="h4 font-weight-normal">{{ $employer->name }}</p>
                </div>
                <div class="col-12 col-sm-3 offset-sm-2 col-lg-2 offset-lg-0 d-flex flex-column">
                    @isset($employer->size)
                        <p class="text-muted mb-1 font-weight-light" style="word-wrap:normal">@lang('Company size')</p>
                        <p class="h4 font-weight-normal">{{ $employer->size }}</p>
                    @endisset
                </div>
                <div class="col-12 col-sm-7 col-lg-4 d-flex flex-column">
                    @isset($employer->website)
                        <p class="text-muted mb-1 font-weight-light">@lang('Company website')</p>
                        <p class="h4 font-weight-normal">
                            <a target="_blank" href="{{ $employer->website }}">{{ $employer->website }}</a>
                        </p>
                    @endisset
                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-title mb-0">
                <ul class="nav nav-tabs nav-justified md-tabs light-blue m-0 no-bottom-radius z-depth-0" id="myTabJust"
                    role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab-just" data-toggle="tab" href="#offers-tab" role="tab"
                           aria-controls="home-just"
                           aria-selected="true">{{ __('Your offers') }}</a></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab-just" data-toggle="tab" href="#applications-tab" role="tab"
                           aria-controls="profile-just"
                           aria-selected="false">{{ __('Applications') }}</a></a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content p-0">
                    <div class="tab-pane fade show active" id="offers-tab" role="tabpanel">
                        <div class="card-title d-flex justify-content-end align-items-center">
                            <a class="btn light-blue darken-2 white-text px-3"
                               href="{{route('offers.create')}}">@lang('Add new offer')
                            </a>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Title')</th>
                                <th scope="col">@lang('Will expire on')</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="table-hover">
                            @foreach( $offers as $offer )
                                <tr>
                                    <td>
                                        <a class="btn btn-link blue-text btn-lg"
                                           href="/#/details/{{$offer->id}}">
                                            {{ $offer->name }}
                                        </a>
                                    </td>
                                    <td class="" style="vertical-align: middle">
                                        {{ $offer->expires_at }}
                                        @if( $offer->isExpired() )
                                            <span class="badge badge-danger ml-2">@lang('Expired')</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            @if( $offer->isExpired() )
                                                <button class="btn btn-warning px-3 m-0 mr-3"
                                                        title="@lang('Refresh offer')"
                                                        onclick="event.preventDefault();document.getElementById('refresh-offer-{{$offer->id}}').submit();">
                                                    <i class="fas fa-redo-alt" aria-hidden="true"></i>
                                                </button>
                                                <form id="refresh-offer-{{$offer->id}}"
                                                      action="{{ route('offers.refresh', $offer) }}" method="POST">
                                                    @csrf
                                                </form>
                                            @endif
                                            <a class="btn btn-default px-3 mr-3" title="@lang('Edit this offer')"
                                               href="{{ route('offers.edit', $offer) }}">
                                                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                            </a>
                                            <button class="btn btn-danger px-3 m-0" title="@lang('Remove this offer')"
                                                    onclick="event.preventDefault();document.getElementById('delete-offer-{{$offer->id}}').submit();">
                                                <i class="fas fa-trash-alt" aria-hidden="true"></i>

                                            </button>
                                            <form id="delete-offer-{{$offer->id}}"
                                                  action="{{ route('offers.destroy', $offer) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $offers->links('components.pagination') }}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="applications-tab" role="tabpanel">
                        <div class="accordion md-accordion accordion-blocks" id="accordion" role="tablist"
                             aria-multiselectable="true">
                            @foreach($offers as $offer)
                                @if ( $offer->jobOfferResponses->count() > 0 )
                                    <div class="card border-light z-depth-0">
                                        <div class="card-header" role="tab">
                                            <a data-toggle="collapse" data-parent="#accordion"
                                               href="#collapseUnfiled{{$offer->id}}"
                                               aria-expanded="true"
                                               aria-controls="collapseUnfiled{{$offer->id}}">
                                                <h5 class="mb-0">
                                                    <span>{{$offer->name}}</span>
                                                    <span class="badge badge-warning jor-badge z-depth-0"
                                                          title="{{ __('Number of application') }}">
                                                        {{ $offer->jobOfferResponses->count() }}
                                                    </span>
                                                    <i class="fas fa-angle-down rotate-icon"></i>
                                                </h5>
                                            </a>
                                        </div>
                                        <div id="collapseUnfiled{{$offer->id}}" class="collapse" role="tabpanel"
                                             aria-labelledby="headingUnfiled"
                                             data-parent="#accordion">
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>{{ __('Full name') }}</th>
                                                        <th>{{ __('Email') }}</th>
                                                        <th>{{ __('CV') }}</th>
                                                        <th>{{ __('Date') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($offer->jobOfferResponses as $job)
                                                        <tr>
                                                            <td>
                                                                {{ $job->name }}
                                                                @if( null !== $job->user_id )
                                                                    <i title="{{ __('User verified') }}"
                                                                       class="fas fa-check-circle ml-1 text-muted"></i>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a class="blue-text" href="mailto:{{ $job->email }}">
                                                                    {{ $job->email }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-primary btn-sm m-0"
                                                                   href="{{ $job->getFile() }}">
                                                                    <i class="fas fa-download mr-1"></i>
                                                                    {{ __('Download') }}
                                                                </a>
                                                            </td>
                                                            <td>{{ $job->created_at->diffForHumans() }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
