@extends('layouts.app')

@section('title')
    Edit profile - @parent
@endsection

@section('javascript')
    <script>
        (function () {
            document.addEventListener('DOMContentLoaded', function () {
                $('.dropify').dropify();
            });
        })(window, document);
    </script>
@endsection

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-start pt-5 full-height">
        <div class="card card-cascade narrower w-100" style="max-width: 650px;">
            <div class="view view-cascade gradient-card-header blue-gradient">
                <h2 class="card-header-title mb-0">{{ __('Update profile') }}</h2>
            </div>
            <div class="card-body card-body-cascade">
                <p class="small text-black-50">@lang('The fields marked with an asterisk (*) are required.')</p>
                <form action="{{ route('client.update', $client) }}" method="POST"
                      enctype="multipart/form-data" id="editProfile">
                    @csrf
                    @method('PATCH')
                    <div class="md-form">
                        <input type="file" name="file" class="dropify" data-height="120" accept="application/pdf"
                               data-default-file="{{ $client->getFile() }}"
                               data-show-remove="false" data-show-errors="true"
                               data-errors-position="outside"/>
                    </div>
                    <div class="md-form">
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                               id="name" value="{{ old('name') ?? $client->name  }}" required>
                        <label for="name">{{ __('Name') }}*</label>

                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="md-form">
                        <input class="form-control @error('website') is-invalid @enderror"
                               type="text" name="links" id="links" required
                               value="{{ old('links') ?? $client->links  }}">
                        <label for="links">{{ __('Github, LinkedIn etc.') }}*</label>
                        @error('links')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="md-form">
                        <button class="btn light-blue darken-2 text-white btn-block" type="submit">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
