@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="row card-content">
                        <form action="{{ $edit ? route('offers.update', $offer) : route('offers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ( $edit ) @method('PATCH') @endif
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input class="validate" name="name" id="name" type="text" value="{{ old('name') ?? $edit ? $offer->name : null }}" required>
                                    <label for="name">{{ __('Title') }}*</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <select name="tech_id" id="technologies" required>
                                        @foreach($technologies as $technology)
                                            <option value="{{ $technology->id }}"
                                                @if ( $edit && $technology->id == $offer->tech_id ) selected @endif
                                            >{{ $technology->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="technologies">{{ __('Technologies') }}</label>
                                </div>
                                <div class="input-field col s4">
                                    <select name="exp_id" id="experience">
                                        @foreach($experiences as $experience)
                                            <option value="{{ $experience->id }}"
                                                @if ( $edit && $experience->id == $offer->exp_id ) selected @endif
                                            >{{ $experience->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="experience">{{ __('Experience') }}</label>
                                </div>
                                <div class="input-field col s4">
                                    <select name="emp_id" id="employment">
                                        @foreach($employments as $employment)
                                            <option value="{{ $employment->id }}"
                                                @if ( $edit && $employment->id == $offer->emp_id ) selected @endif
                                            >{{ $employment->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="employment">{{ __('Employment') }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <input class="validate" name="salary_from" id="salary_from" type="text" value="{{ old('salary_from') ?? $edit ? $offer->salary_from : null }}">
                                    <label for="salary_from">{{ __('Salary From') }}</label>
                                </div>
                                <div class="input-field col s4">
                                    <input class="validate" name="salary_to" id="salary_to" type="text" value="{{ old('salary_to') ?? $edit ? $offer->salary_to : null }}">
                                    <label for="salary_to">{{ __('Salary To') }}</label>
                                </div>
                                <div class="input-field col s4">
                                    <select name="currency_id" id="currency">
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency->id }}"
                                                @if ( $edit && $currency->id == $offer->currency_id ) selected @endif
                                            >{{ $currency->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="currency">{{ __('Currency') }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <input class="validate" name="disclaimer" id="disclaimer" type="text" value="{{ old('disclaimer') ?? $edit ? $offer->disclaimer : null }}" required >
                                    <label for="disclaimer">{{ __('Disclaimer') }}*</label>
                                </div>
                                <div class="input-field col s4">
                                    <input class="validate" name="website" id="website" type="text" value="{{ old('website') ?? $edit ? $offer->website : null }}">
                                    <label for="website">{{ __('Website') }}</label>
                                </div>
                                <div class="input-field col s4">
                                    <input class="validate" name="contact" id="contact" type="text" value="{{ old('contact') ?? $edit ? $offer->contact : null }}" required>
                                    <label for="contact">{{ __('Contact') }}*</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="summernote">Description*</label>
                                    <textarea name="description" id="summernote">{!! old('description') ?? $offer->description ?? '' !!}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <input class="validate" name="city" id="city" type="text" value="{{ old('city') ?? $edit ? $offer->city : null }}" required>
                                    <label for="city">{{ __('City') }}*</label>
                                </div>
                                <div class="input-field col s4">
                                    <input class="validate" name="street" id="street" type="text" value="{{ old('street') ?? $edit ? $offer->street : null }}" required>
                                    <label for="street">{{ __('Street') }}*</label>
                                </div>
                                <div class="input-field col s3">
                                    <label>
                                        <input type="checkbox" name="remote" id="remote" class="filled-in" {{ old('remote') ? '' : ($edit ? ($offer->remote ? 'checked' : '') : '') }}/>
                                        <span>Remote</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 right-align">
                                    <button class="btn waves-effect waves-light" type="submit">
                                        {{ $edit ? __('Update') : __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#summernote').summernote({
            placeholder: 'Description',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['misc', ['undo', 'redo']],
                ['font', ['bold', 'underline', 'italic', 'clear', 'fontname', 'fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['codeview', 'help']]
            ]
        });
    </script>
@endsection
