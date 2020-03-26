@extends('layouts.app')

@section('title')
    Edit profile - @parent
@endsection

@section('javascript')
<script defer>
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
    <div class="container" style="display: flex; justify-content: center">
        <form action="{{ route('employer.update', $employer) }}" method="POST"
              enctype="multipart/form-data" id="editProfile" class="card" style="max-width: 600px;">
            <div class="card-content left-align">
                <div class="row">
                    <span class="card-title center-align">{{ __('Update profile') }}</span>
                </div>

                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col s12">
                        <input type="file" name="logo" class="dropify" data-height="120"
                               data-default-file="{{ $employer->getLogo() }}" data-show-remove="false"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <label for="name">Name</label>
                        <input class="validate @error('name') invalid @enderror" type="text" name="name" id="name"
                               value="{{ old('name') ?? $employer->name  }}"
                               required>

                        @error('name')
                        <span class="helper-text red-text" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col s12 m6">
                        <label for="website">Website</label>
                        <input class="validate @error('website') invalid @enderror" type="text" name="website" id="website"
                               value="{{ old('website') ?? $employer->website  }}"
                               required>

                        @error('website')
                        <span class="helper-text red-text" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col s12 m6">
                        <label for="size">Size of company</label>
                        <input class="validate @error('website') invalid @enderror" type="text" name="size" id="size"
                               value="{{ old('size') ?? $employer->size  }}"
                               required>

                        @error('size')
                        <span class="helper-text red-text" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-action right-align">
                <button class="btn waves-effect waves-light" type="submit" name="action">
                    {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
@endsection
