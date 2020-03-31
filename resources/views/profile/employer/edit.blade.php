@extends('layouts.app')

@section('title')
    Edit profile - @parent
@endsection

@section('javascript')
    <script>
        (function () {
            document.addEventListener('DOMContentLoaded', function () {
                $('.dropify').dropify({
                    tpl: {
                        filename: '',
                    }
                });
            });
        })(window, document);
    </script>
@endsection

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-start pt-5 full-height">
        <div class="card card-cascade narrower w-100" style="max-width: 650px;">
            <div class="view view-cascade gradient-card-header blue-gradient">
                <h2 class="card-header-title">{{ __('Update profile') }}</h2>
            </div>
            <div class="card-body card-body-cascade">
                <p class="small text-black-50">The fields marked with an asterisk (*) are required.</p>
                <form action="{{ route('employer.update', $employer) }}" method="POST"
                      enctype="multipart/form-data" id="editProfile">
                    @csrf
                    @method('PATCH')
                    <div class="md-form">
                        <input type="file" name="logo" class="dropify" data-height="120"
                               data-default-file="{{ $employer->getLogo() }}"
                               data-show-remove="false" data-show-errors="true"
                               data-errors-position="outside"/>
                    </div>
                    <div class="md-form">
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                               id="name" value="{{ old('name') ?? $employer->name  }}" required>
                        <label for="name">{{ __('Company name') }}</label>

                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="md-form form-row">
                            <div class="col-sm-12 col-md-6 mb-sm-3">
                                <input class="form-control @error('website') is-invalid @enderror"
                                       type="text" name="website" id="website" required
                                       value="{{ old('website') ?? $employer->website  }}">
                                <label for="website" style="padding-left: .3rem">{{ __('Company website') }}</label>
                                @error('website')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <input class="form-control @error('size') is-invalid @enderror"
                                       type="text" name="size" id="size" required
                                       value="{{ old('size') ?? $employer->size  }}">
                                <label for="company-size" style="padding-left: .3rem">{{ __('Company size') }}</label>
                                @error('size')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                        </div>
                    </div>
                    <div class="md-form">
                        <button class="btn light-blue darken-2 text-white btn-block" type="submit">
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
