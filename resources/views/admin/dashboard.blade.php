@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col s12 m4">
            <div class="container">
                <div class="card-panel">
                    <span class="small">Liczba użytkowników: </span><br>
                    <h5 class="large"><b>{{ $user_count }}</b></h5>
                </div>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="container">
                <div class="card-panel">
                    <span class="small">Liczba ofert: </span><br>
                    <h5 class="large"><b>{{ $offer_count }}</b></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">Ostatni nowi użytkownicy</div>
                    <table>
                        <thead>
                        <tr>
                            <th></th>
                            <th>Nazwa</th>
                            <th>Oferty</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $latest_employers as $employer )
                            <tr>
                                <td><img class="responsive-img circle" style="max-height: 48px"
                                         src="{{ $employer->getLogo() }}" alt=""></td>
                                <td>{{ $employer->name }}</td>
                                <td>{{ $employer->user()->first()->offers()->count() }}</td>
                                <td class="right-align">
                                    <a class="waves-effect waves-light btn btn-small red" title="Remove this employer"
                                       href="#!"
                                       onclick="event.preventDefault();document.getElementById('delete-employer-{{$employer->id}}').submit();">
                                        <i class="material-icons">delete</i>
                                        <form id="delete-employer-{{$employer->id}}"
                                              action="{{ route('admin.destroy.employer', $employer) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">Ostatnie nowe oferty</div>
                    <table>
                        @foreach( $latest_offers as $offer)
                            <tr>
                                <td><a href="/#/details/{{ $offer->id }}">{{ $offer->name }}</a></td>
                                <td>{{ $offer->user()->first()->profile()->first()->name }}</td>
                                <td>{{ $offer->created_at->diffForHumans() }}</td>
                                <td class="right-align">
                                    <a class="waves-effect waves-light btn btn-small" title="Edit this offer"
                                       href="{{ route('offers.edit', $offer) }}">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <a class="waves-effect waves-light btn btn-small red" title="Remove this offer"
                                       href="#!"
                                       onclick="event.preventDefault();document.getElementById('delete-offer-{{$offer->id}}').submit();">
                                        <i class="material-icons">delete</i>
                                        <form id="delete-offer-{{$offer->id}}"
                                              action="{{ route('admin.destroy.offer', $offer) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

