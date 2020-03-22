@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Hello {{ auth()->user()->profile()->first()->name }}!</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Your offers</span>
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
                                    <td>{{ $offer->name }}</td>
                                    <td class="right-align">
                                        <a class="waves-effect waves-light btn btn-small" href="#!"><i class="material-icons">edit</i></a>
                                        <a class="waves-effect waves-light btn btn-small light-blue" href="#!"><i class="material-icons">refresh</i></a>
                                        <a class="waves-effect waves-light btn btn-small red" href="#!"><i class="material-icons">delete</i></a>
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
