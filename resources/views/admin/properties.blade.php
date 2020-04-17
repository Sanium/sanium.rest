@extends('layouts.admin')

@section('admin.content')
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
                                            <button class="btn btn-danger btn-sm m-0 btn-form-delete"
                                               title="Remove this offer"
                                               onclick="event.preventDefault();document.getElementById('delete-tech-{{ $el->id }}').submit();">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <form id="delete-tech-{{ $el->id }}"
                                                  action="" method="POST">
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
                                                <button class="btn btn-danger btn-sm m-0 btn-form-delete"
                                                        title="Remove this offer"
                                                        onclick="event.preventDefault();document.getElementById('delete-exp-{{ $el->id }}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <form id="delete-exp-{{ $el->id }}"
                                                      action="{{ route($experiences_url, $el) }}" method="POST">
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
                                                <button class="btn btn-danger btn-sm m-0" title="Remove this offer"
                                                   onclick="event.preventDefault();document.getElementById('delete-emp-{{ $el->id }}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <form id="delete-emp-{{ $el->id }}"
                                                      action="{{ route($employments_url, $el) }}" method="POST">
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
                                        <td class="align-middle"><span id="edit-cur-{{ $el->id }}"
                                                                       contenteditable="true">{{ $el->name }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-danger btn-sm m-0" title="Remove this offer"
                                                   onclick="event.preventDefault();document.getElementById('delete-cur-{{ $el->id }}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <form id="delete-cur-{{ $el->id }}"
                                                      action="{{ route($currencies_url, $el) }}" method="POST">
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
            </div>
        </section>
    </div>
@endsection

