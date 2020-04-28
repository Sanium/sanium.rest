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
            <div class="card-body">
                <div class="card-title d-flex justify-content-between align-items-center">
                    <h4>@lang('Your offers')</h4>
                    <a class="btn light-blue darken-2 white-text px-3"
                       href="{{route('offers.create')}}">@lang('Add new offer')
                    </a>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">@lang('Title')</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody class="table-hover">
                    @foreach( $offers as $offer )
                        <tr>
                            <td>
                                <a class="btn btn-link blue-text btn-lg"
                                   href="/#/details/{{$offer->id}}">{{ $offer->name }}</a>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-default px-3 mr-3" title="@lang('Edit this offer')"
                                       href="{{ route('offers.edit', $offer) }}">
                                        <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-danger px-3" title="@lang('Remove this offer')" href="#!"
                                       onclick="event.preventDefault();document.getElementById('delete-offer-{{$offer->id}}').submit();">
                                        <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                        <form id="delete-offer-{{$offer->id}}"
                                              action="{{ route('offers.destroy', $offer) }}" method="POST">
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
                <div class="d-flex justify-content-center">
                    {{ $offers->links('components.pagination') }}
                </div>

            </div>
        </div>
    </div>
@endsection
