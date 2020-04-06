@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-0">
        <section class="mx-0 mx-xl-5 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h4>{{ __('Users') }}</h4>
                    </div>
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('slug') }}</th>
                            <th>{{ __('Size') }}</th>
                            <th>{{ __('Website') }}</th>
                            <th>{{ __('E-mail') }}</th>
                            <th>{{ __('Created') }}</th>
                            <th>{{ __('Updated') }}</th>
                            <th>{{ __('Total offers') }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $employers as $employer )
                            <tr>
                                <td class="align-middle"><img class="img-fluid z-depth-1 rounded-circle"
                                                              style="max-height: 30px"
                                                              src="{{ $employer->getLogo() }}" alt=""></td>
                                <td class="align-middle">{{ $employer->name }}</td>
                                <td class="align-middle">{{ $employer->user()->first()->name }}</td>
                                <td class="align-middle">{{ $employer->size }}</td>
                                <td class="align-middle"><a class="light-blue-text text-darken-2"
                                                            href="{{ $employer->website }}">{{ $employer->website }}</a>
                                </td>
                                <td class="align-middle"><a class="light-blue-text text-darken-2"
                                                            href="mailto:{{ $employer->user()->first()->email }}">{{ $employer->user()->first()->email }}</a>
                                </td>
                                <td class="align-middle">{{ $employer->created_at->diffForHumans() }}</td>
                                <td class="align-middle">{{ $employer->updated_at->diffForHumans() }}</td>
                                <td class="align-middle">{{ $employer->user()->first()->offers()->count() }}</td>
                                <td class="align-middle"><a class="light-blue-text text-darken-2"
                                                            href="{{ route('admin.employers.offers', $employer) }}">see
                                        all offers</a></td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-danger btn-sm m-0"
                                                title="Remove this employer"
                                                onclick="event.preventDefault();document.getElementById('delete-employer-{{$employer->id}}').submit();">
                                            <i class="fas fa-trash"></i>

                                        </button>
                                        <form id="delete-employer-{{$employer->id}}"
                                              action="{{ route('admin.destroy.employer', $employer) }}"
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
                    <div class="d-flex justify-content-center">
                        {{ $employers->links('components.pagination') }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

