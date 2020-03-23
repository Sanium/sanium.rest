@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="row card-content">
                        <form action="{{ route('offers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col s12 input-field">
                                    <input class="validate" name="name" id="name" type="text" required>
                                    <label for="name">{{ __('Title') }}*</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <select name="tech_id" id="technologies" required>
                                        @foreach($technologies as $technologie)
                                            <option value="{{ $technologie->id }}">{{ $technologie->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="technologies">{{ __('Technologies') }}</label>
                                </div>
                                <div class="input-field col s4">
                                    <select name="exp_id" id="experience">
                                        @foreach($experiences as $experience)
                                            <option value="{{ $experience->id }}">{{ $experience->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="experience">{{ __('Experience') }}</label>
                                </div>
                                <div class="input-field col s4">
                                    <select name="emp_id" id="employment">
                                        @foreach($employments as $employment)
                                            <option value="{{ $employment->id }}">{{ $employment->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="employment">{{ __('Employment') }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <input class="validate" name="salary_from" id="salary_from" type="text">
                                    <label for="salary_from">{{ __('Salary From') }}</label>
                                </div>
                                <div class="input-field col s4">
                                    <input class="validate" name="salary_to" id="salary_to" type="text">
                                    <label for="salary_to">{{ __('Salary To') }}</label>
                                </div>
                                <div class="input-field col s4">
                                    <select name="currency_id" id="currency">
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="currency">{{ __('Currency') }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <input class="validate" name="disclaimer" id="disclaimer" type="text" required>
                                    <label for="disclaimer">{{ __('Disclaimer') }}*</label>
                                </div>
                                <div class="input-field col s4">
                                    <input class="validate" name="website" id="website" type="text">
                                    <label for="website">{{ __('Website') }}</label>
                                </div>
                                <div class="input-field col s4">
                                    <input class="validate" name="contact" id="contact" type="text" required>
                                    <label for="contact">{{ __('Contact') }}*</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="summernote">Description*</label>
                                    <textarea name="description" id="summernote"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <input class="validate" name="city" id="city" type="text" required>
                                    <label for="city">{{ __('City') }}*</label>
                                </div>
                                <div class="input-field col s4">
                                    <input class="validate" name="street" id="street" type="text" required>
                                    <label for="street">{{ __('Street') }}</label>
                                </div>
                                <div class="input-field col s3">
                                    <label>
                                        <input type="checkbox" name="remote" id="remote" class="filled-in"/>
                                        <span>Remote</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 right-align">
                                    <button class="btn waves-effect waves-light" type="submit">
                                        {{ __('Create') }}
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
