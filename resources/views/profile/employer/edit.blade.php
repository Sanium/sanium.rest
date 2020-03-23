@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2 l6 offset-l3 xl4 offset-xl4">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <span class="card-title center-align">{{ __('Edit profile') }}</span>
                        </div>
                        <form action="{{ route('employer.update', $employer) }}" method="POST"
                              enctype="multipart/form-data" id="editProfile">
                            @csrf
                            @method('PATCH')
                            <div class="row center-align">
                                <div class="col s12">
                                    <input type="file" name="logo" class="dropify" data-height="80"
                                           data-default-file="{{ $employer->getImage() }}" data-show-remove="false"/>
                                </div>
                            </div>
                            <div class="row">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') ?? $employer->name  }}"
                                       required>
                            </div>
                            <div class="row">
                                <label for="name">Website</label>
                                <input type="text" name="website" id="website"
                                       value="{{ old('website') ?? $employer->website  }}"
                                       required>
                            </div>
                            <div class="row">
                                <label for="name">Size of company</label>
                                <input type="text" name="size" id="size" value="{{ old('size') ?? $employer->size  }}"
                                       required>
                            </div>
                            <div class="row">
                                <button class="col s12 btn waves-effect waves-light" type="submit"
                                        name="action">{{ __('Submit') }}
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
