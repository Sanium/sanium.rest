@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col s12 m6 l3">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s6">
                        <div class="card-title">Technologies</div>
                    </div>
                    <div class="col s6 right-align">
                        <a class="waves-effect waves-light btn btn-small"
                           href="#!">
                            <i class="material-icons">add</i>
                        </a>
                    </div>
                </div>
                <table>
                    @foreach( $technologies as $el )
                        <tr>
                            <td>{{ $el->name }}</td>
                            <td class="right-align">
                                <a class="waves-effect waves-light btn btn-small" title="Edit this offer"
                                   href="{{ route('offers.edit', $el) }}">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a class="waves-effect waves-light btn btn-small red" title="Remove this offer"
                                   href="#!"
                                   onclick="event.preventDefault();document.getElementById('delete-offer-{{ $el->id }}').submit();">
                                    <i class="material-icons">delete</i>
                                    <form id="delete-offer-{{ $el->id }}"
                                          action="{{ route('admin.destroy.offer', $el) }}" method="POST">
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
    <div class="col s12 m6 l9">
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s6">
                                <div class="card-title">Experiences</div>
                            </div>
                            <div class="col s6 right-align">
                                <a class="waves-effect waves-light btn btn-small"
                                   href="#!">
                                    <i class="material-icons">add</i>
                                </a>
                            </div>
                        </div>
                        <table>
                            @foreach( $experiences as $el )
                                <tr>
                                    <td>{{ $el->name }}</td>
                                    <td class="right-align">
                                        <a class="waves-effect waves-light btn btn-small" title="Edit this offer"
                                           href="{{ route('offers.edit', $el) }}">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a class="waves-effect waves-light btn btn-small red" title="Remove this offer"
                                           href="#!"
                                           onclick="event.preventDefault();document.getElementById('delete-offer-{{ $el->id }}').submit();">
                                            <i class="material-icons">delete</i>
                                            <form id="delete-offer-{{ $el->id }}"
                                                  action="{{ route('admin.destroy.offer', $el) }}" method="POST">
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
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s6">
                                <div class="card-title">Employments</div>
                            </div>
                            <div class="col s6 right-align">
                                <a class="waves-effect waves-light btn btn-small"
                                   href="#!">
                                    <i class="material-icons">add</i>
                                </a>
                            </div>
                        </div>
                        <table>
                            @foreach( $employments as $el )
                                <tr>
                                    <td>{{ $el->name }}</td>
                                    <td class="right-align">
                                        <a class="waves-effect waves-light btn btn-small" title="Edit this offer"
                                           href="{{ route('offers.edit', $el) }}">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a class="waves-effect waves-light btn btn-small red" title="Remove this offer"
                                           href="#!"
                                           onclick="event.preventDefault();document.getElementById('delete-offer-{{ $el->id }}').submit();">
                                            <i class="material-icons">delete</i>
                                            <form id="delete-offer-{{ $el->id }}"
                                                  action="{{ route('admin.destroy.offer', $el) }}" method="POST">
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
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s6">
                                <div class="card-title">Currencies</div>
                            </div>
                            <div class="col s6 right-align">
                                <a class="waves-effect waves-light btn btn-small"
                                   href="#!">
                                    <i class="material-icons">add</i>
                                </a>
                            </div>
                        </div>
                        <table>
                            @foreach( $currencies as $el )
                                <tr>
                                    <td>{{ $el->name }}</td>
                                    <td class="right-align">
                                        <a class="waves-effect waves-light btn btn-small" title="Edit this offer"
                                           href="{{ route('offers.edit', $el) }}">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a class="waves-effect waves-light btn btn-small red" title="Remove this offer"
                                           href="#!"
                                           onclick="event.preventDefault();document.getElementById('delete-offer-{{ $el->id }}').submit();">
                                            <i class="material-icons">delete</i>
                                            <form id="delete-offer-{{ $el->id }}"
                                                  action="{{ route('admin.destroy.offer', $el) }}" method="POST">
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
    </div>
</div>

@endsection

