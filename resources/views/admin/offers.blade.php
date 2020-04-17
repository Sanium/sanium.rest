@extends('layouts.admin')

@section('admin.content')
    <div class="container-fluid px-0">
        <section class="mx-0 mx-xl-5 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <h4>{{ __('All offers of employer') }} <a href="{{ route('admin.employers.show', $employer) }}">{{ $employer->name }}</a></h4>
                        </div>
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Employer') }}</th>
                                <th>{{ __('Created') }}</th>
                                <th>{{ __('Updated') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $offers as $offer )
                                <tr>
                                    <td class="align-middle"><a href="/#/details/{{ $offer->id }}">{{ $offer->name }}</a></td>
                                    <td class="align-middle">{{ $offer->user()->first()->profile()->first()->name }}</td>
                                    <td class="align-middle">{{ $offer->created_at->diffForHumans() }}</td>
                                    <td class="align-middle">{{ $offer->updated_at->diffForHumans() }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-danger btn-sm m-0" title="Remove this offer"
                                                    onclick="event.preventDefault();document.getElementById('delete-offer-{{$offer->id}}').submit();">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <form id="delete-offer-{{$offer->id}}"
                                                  action="{{ route('admin.destroy.offer', $offer) }}" method="POST">
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
                </div>
        </section>
    </div>
@endsection

