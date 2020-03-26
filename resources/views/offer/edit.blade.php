@extends('layouts.app')

@section('title')
    {{  $edit ? 'Update offer' : 'Create offer' }} - @parent
@endsection

@section('content')
    <div class="container">
        <form action="{{ $edit ? route('offers.update', $offer) : route('offers.store') }}"
              method="POST" enctype="multipart/form-data" class="card">
            <div class="card-content">
                <header class="card-title row">
                    <div class="col s12">
                        <h4>{{ $edit ? __('Update offer for') : __('Create new offer') }}</h4>
                        <p class="small grey-text text-darken-3">{{ __('The fields marked with an asterisk (*) are required.') }}</p>
                    </div>
                </header>

                @csrf
                @if ( $edit ) @method('PATCH') @endif
                <div class="row">
                    <div class="col s12 input-field">
                        <input name="name" id="name" type="text" required
                               value="{{ old('name') ?? $offer->name ?? '' }}"
                               class="validate @error('name') invalid @enderror">
                        <label for="name">{{ __('Title') }}*</label>
                        @error('name')
                        <span class="helper-text red-text" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        <select name="tech_id" id="technologies" class="no-autoinit" required>
                            @foreach($technologies as $technology)
                                <option value="{{ $technology->id }}"
                                        @if ( $edit && $technology->id == $offer->tech_id || $technology->id == old('tech_id') ) selected @endif
                                >{{ $technology->name }}</option>
                            @endforeach
                        </select>
                        <label for="technologies">{{ __('Technologies') }}</label>
                    </div>
                    <div class="input-field col s12 m4">
                        <select name="exp_id" id="experience" class="no-autoinit" required>
                            @foreach($experiences as $experience)
                                <option value="{{ $experience->id }}"
                                        @if ( $edit && $experience->id == $offer->exp_id || $experience->id == old('exp_id') ) selected @endif
                                >{{ $experience->name }}</option>
                            @endforeach
                        </select>
                        <label for="experience">{{ __('Experience') }}</label>
                    </div>
                    <div class="input-field col s12 m4">
                        <select name="emp_id" id="employment" class="no-autoinit" required>
                            @foreach($employments as $employment)
                                <option value="{{ $employment->id }}"
                                        @if ( $edit && $employment->id == $offer->emp_id || $employment->id == old('emp_id') ) selected @endif
                                >{{ $employment->name }}</option>
                            @endforeach
                        </select>
                        <label for="employment">{{ __('Employment') }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <input name="salary_from" id="salary_from" type="text"
                               value="{{ old('salary_from') ?? $offer->salary_from ?? '' }}"
                               class="validate @error('salary_from') invalid @enderror">
                        <label for="salary_from">{{ __('Salary From') }}</label>
                        @error('salary_from')
                        <span class="helper-text red-text" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s4">
                        <input name="salary_to" id="salary_to" type="text"
                               value="{{ old('salary_to') ?? $offer->salary_to ?? '' }}"
                               class="validate @error('salary_to') invalid @enderror">
                        <label for="salary_to">{{ __('Salary To') }}</label>
                        @error('salary_to')
                        <span class="helper-text red-text" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s4">
                        <select name="currency_id" id="currency" class="no-autoinit" required>
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}"
                                        @if ( $edit && $currency->id == $offer->currency_id || $currency->id == old('currency_id') ) selected @endif
                                >{{ $currency->name }}</option>
                            @endforeach
                        </select>
                        <label for="currency">{{ __('Currency') }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <input name="disclaimer" id="disclaimer" type="text" required
                               value="{{ old('disclaimer') ?? $offer->disclaimer ?? '' }}"
                               class="validate @error('disclaimer') invalid @enderror">
                        <label for="disclaimer">{{ __('Disclaimer') }}*</label>
                    </div>
                    <div class="input-field col s4">
                        <input name="website" id="website" type="text"
                               value="{{ old('website') ?? $offer->website ?? '' }}"
                               class="validate @error('website') invalid @enderror">
                        <label for="website">{{ __('Website') }}</label>
                    </div>
                    <div class="input-field col s4">
                        <input name="contact" id="contact" type="text" required
                               value="{{ old('contact') ?? $offer->contact ?? '' }}"
                               class="validate @error('contact') invalid @enderror">
                        <label for="contact">{{ __('Contact') }}*</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <label for="description" class="hide">Description*</label>
                        <textarea id="description" name="description" class="summernote"
                                  placeholder="Description*">{!! old('description') ?? ($offer->description ?? '') !!}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <input name="city" id="city" type="text" required
                               value="{{ old('city') ?? $offer->city ?? '' }}"
                               class="validate @error('salary_from') invalid @enderror">
                        <label for="city">{{ __('City') }}*</label>
                    </div>
                    <div class="input-field col s4">
                        <input name="street" id="street" type="text" required
                               value="{{ old('street') ?? $offer->street ?? '' }}"
                               class="validate @error('salary_from') invalid @enderror">
                        <label for="street">{{ __('Street') }}*</label>
                    </div>
                    <div class="input-field col s3">
                        <label>
                            <input type="checkbox" name="remote" id="remote" class="filled-in"
                                {{ old('remote') ? '' : ($edit ? ($offer->remote ? 'checked' : '') : '') }}/>
                            <span>Remote</span>
                        </label>
                    </div>
                </div>

            </div>
            <div class="card-action right-align">
                <button class="btn waves-effect waves-light" type="submit">
                    {{ $edit ? __('Update') : __('Create') }}
                </button>
            </div>
        </form>
    </div>
@endsection
