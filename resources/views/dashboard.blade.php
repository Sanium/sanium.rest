@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="row card-content">
                        <div class="valign-wrapper">
                            <div class="col">
                                <img name="company-logo" class="responsive-img circle" width="60"
                                     src="{{ $employer->getLogo() }}">
                            </div>
                            <div class="col">
                                <p class="small">Hello</p>
                                <span class="card-title"><b>{{ $employer->name }}</b></span>
                            </div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col">
                                @isset($employer->size)
                                <p class="small">Company size</p>
                                <span class="card-title"><b>{{ $employer->size }}</b></span>
                                @endisset
                            </div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col">
                                @isset($employer->website)
                                <p class="small">Website</p>
                                <span
                                    class="card-title ">
                                        <a
                                            target="_blank" href="{{ $employer->website }}">{{ $employer->website }}
                                        </a>
                                </span>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s6">
                                <span class="card-title left-align">Your offers</span>
                            </div>
                            <div class="col s6 right-align">
                                <a class="waves-effect waves-light btn"
                                   href="{{route('offers.create')}}">{{'Add New Offer'}}</a>
                            </div>
                        </div>
                        <table class="highlight">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th class="right-align">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $offers as $offer )
                                <tr>
                                    <td>{{ $offer->id }}</td>
                                    <td><a href="/#/details/{{$offer->id}}">{{ $offer->name }}</a></td>
                                    <td class="right-align">
                                        <a class="waves-effect waves-light btn btn-small" title="Edit this offer"
                                           href="{{ route('offers.edit', $offer) }}">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a class="waves-effect waves-light btn btn-small red" title="Remove this offer" href="#!"
                                           onclick="event.preventDefault();document.getElementById('delete-offer-{{$offer->id}}').submit();">
                                            <i class="material-icons">delete</i>
                                            <form id="delete-offer-{{$offer->id}}" action="{{ route('offers.destroy', $offer) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $offers->links('components.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
