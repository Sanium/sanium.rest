@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-0">
        <section class="row mx-0 mx-xl-5 mt-5">
            <div class="col-12 col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <h4>{{ __('Technologies') }}</h4>
                        </div>
                        <table class="table table-sm">
                            <tbody>
                            @foreach( $technologies as $el )
                                <tr>
                                    <td class="align-middle">{{ $el->name }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-end">
                                        <a class="btn btn-default btn-sm mr-2" title="Edit this offer"
                                           href="#!">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm m-0" title="Remove this offer"
                                           href="#!"
                                           onclick="event.preventDefault();document.getElementById('delete-offer-{{ $el->id }}').submit();">
                                            <i class="fas fa-trash"></i>
                                            <form id="delete-tech-{{ $el->id }}"
                                                  action="#!" method="POST">
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
            <div class="col-12 col-md-6 col-lg-7 row">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex justify-content-between align-items-center">
                                <h4>{{ __('Experiences') }}</h4>
                            </div>
                            <table class="table table-sm">
                                <tbody>
                                @foreach( $experiences as $el )
                                    <tr>
                                        <td class="align-middle">{{ $el->name }}</td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-end">
                                                <a class="btn btn-default btn-sm mr-2" title="Edit this offer"
                                                   href="#!">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-danger btn-sm m-0" title="Remove this offer"
                                                   href="#!"
                                                   onclick="event.preventDefault();document.getElementById('delete-offer-{{ $el->id }}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                    <form id="delete-tech-{{ $el->id }}"
                                                          action="#!" method="POST">
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
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex justify-content-between align-items-center">
                                <h4>{{ __('Employments') }}</h4>
                            </div>
                            <table class="table table-sm">
                                <tbody>
                                @foreach( $employments as $el )
                                    <tr>
                                        <td class="align-middle">{{ $el->name }}</td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-end">
                                                <a class="btn btn-default btn-sm mr-2" title="Edit this offer"
                                                   href="#!">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-danger btn-sm m-0" title="Remove this offer"
                                                   href="#!"
                                                   onclick="event.preventDefault();document.getElementById('delete-offer-{{ $el->id }}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                    <form id="delete-tech-{{ $el->id }}"
                                                          action="#!" method="POST">
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
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex justify-content-between align-items-center">
                                <h4>{{ __('Currencies') }}</h4>
                            </div>
                            <table class="table table-sm">
                                <tbody>
                                @foreach( $currencies as $el )
                                    <tr>
                                        <td class="align-middle">{{ $el->name }}</td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-end">
                                                <a class="btn btn-default btn-sm mr-2" title="Edit this offer"
                                                   href="#!">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-danger btn-sm m-0" title="Remove this offer"
                                                   href="#!"
                                                   onclick="event.preventDefault();document.getElementById('delete-offer-{{ $el->id }}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                    <form id="delete-tech-{{ $el->id }}"
                                                          action="#!" method="POST">
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
            </div>
        </section>
    </div>
@endsection

