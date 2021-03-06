@extends('layouts.app')

@section('title')
    {{  $edit ? 'Update offer' : 'Create offer' }} - @parent
@endsection

@section('javascript')
    <script src="{{ asset('js/material-select.min.js') }}"></script>
    <script>
        (function () {
            window.addEventListener('load', function () {
                $('.mdb-select').materialSelect();
                $('.chips').materialChip({
                    placeholder: '@lang('Enter a skill')',
                    secondaryPlaceholder: '@lang('+Skill')',
                    data: JSON.parse('{!! $offer && $offer->tech_stack ? $offer->tech_stack : '{}'  !!}')
                });
                $('#offer-form').on('submit', function (e) {
                    e.preventDefault();
                    document.getElementById("tech_stack").value = JSON.stringify($('.chips').materialChip('data'));
                    $(this).unbind('submit').submit()
                });
            });
        })(window, document);
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="card card-cascade narrower z-depth-5 w-100 my-5">
            <div class="view view-cascade gradient-card-header blue-gradient">
                <h2 class="card-header-title">{{ $edit ? __('Update offer for :name', ['name' => $offer->name ?? '']) : __('Create new offer') }}</h2>
            </div>
            <div class="card-body card-body-cascade">
                <p class="small text-black-50">@lang('The fields marked with an asterisk (*) are required.')</p>
                <form id="offer-form" action="{{ $edit ? route('offers.update', $offer) : route('offers.store') }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ( $edit ) @method('PATCH') @endif
                    <div class="row">
                        <div class="col">
                            <div class="md-form">
                                <input name="name" id="name" type="text" required
                                       value="{{ old('name') ?? $offer->name ?? '' }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                <label for="name">{{ __('Title') }}*</label>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="md-form">
                                <select name="tech_id" id="technologies" class="mdb-select" required>
                                    @foreach($technologies as $technology)
                                        <option value="{{ $technology->id }}"
                                                @if ( ($edit && $technology->id === $offer->tech_id) || $technology->id === old('tech_id') ) selected @endif
                                        >{{ $technology->name }}</option>
                                    @endforeach
                                </select>
                                <label for="technologies">{{ __('Technologies') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="md-form">
                                <select name="exp_id" id="experience" class="mdb-select" required>
                                    @foreach($experiences as $experience)
                                        <option value="{{ $experience->id }}"
                                                @if ( ($edit && $experience->id === $offer->exp_id) || $experience->id === old('exp_id') ) selected @endif
                                        >{{ $experience->name }}</option>
                                    @endforeach
                                </select>
                                <label for="experience">{{ __('Experience') }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="md-form">
                                <select name="emp_id" id="employment" class="mdb-select" required>
                                    @foreach($employments as $employment)
                                        <option value="{{ $employment->id }}"
                                                @if ( ($edit && $employment->id === $offer->emp_id) || $employment->id === old('emp_id') ) selected @endif
                                        >{{ __($employment->name) }}</option>
                                    @endforeach
                                </select>
                                <label for="employment">{{ __('Employment') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="md-form">
                                <input name="salary_from" id="salary_from" type="text"
                                       value="{{ old('salary_from') ?? $offer->salary_from ?? '' }}"
                                       class="form-control @error('salary_from') is-invalid @enderror">
                                <label for="salary_from">{{ __('Salary From') }}</label>
                                @error('salary_from')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="md-form">
                                <input name="salary_to" id="salary_to" type="text"
                                       value="{{ old('salary_to') ?? $offer->salary_to ?? '' }}"
                                       class="form-control @error('salary_to') is-invalid @enderror">
                                <label for="salary_to">{{ __('Salary To') }}</label>
                                @error('salary_to')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="md-form">
                                <select name="currency_id" id="currency" class="mdb-select" required>
                                    @foreach($currencies as $currency)
                                        <option value="{{ $currency->id }}"
                                                @if ( ($edit && $currency->id === $offer->currency_id) || $currency->id === old('currency_id') ) selected @endif
                                        >{{ $currency->name }}</option>
                                    @endforeach
                                </select>
                                <label for="currency">{{ __('Currency') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4 offset-md-4">
                            <div class="md-form">
                                <input name="website" id="website" type="text"
                                       value="{{ old('website') ?? $offer->website ?? '' }}"
                                       class="form-control @error('website') is-invalid @enderror">
                                <label for="website">{{ __('Website') }}</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="md-form">
                                <input name="contact" id="contact" type="text" required
                                       value="{{ old('contact') ?? $offer->contact ?? '' }}"
                                       class="form-control @error('contact') is-invalid @enderror">
                                <label for="contact">{{ __('Contact') }}*</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input id="tech_stack" name="tech_stack" type="hidden">
                            <div class="chips chips-placeholder"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="description" class="sr-only">Description*</label>
                            <textarea id="description" name="description" class="summernote"
                                      placeholder="@lang('Description')*">{!! old('description') ?? ($offer->description ?? '') !!}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="md-form">
                                <input name="city" id="city" type="text" required
                                       value="{{ old('city') ?? $offer->city ?? '' }}"
                                       class="form-control @error('salary_from') is-invalid @enderror">
                                <label for="city">{{ __('City') }}*</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="md-form">
                                <input name="street" id="street" type="text" required
                                       value="{{ old('street') ?? $offer->street ?? '' }}"
                                       class="form-control @error('salary_from') is-invalid @enderror">
                                <label for="street">{{ __('Street') }}*</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="md-form form-check">
                                <input type="checkbox" class="form-check-input" id="remote" name="remote"
                                    {{ (!old('remote') && $edit && $offer->remote) ? 'checked' : (bool) old('remote') }}>
                                <label class="form-check-label" for="remote">@lang('Remote')</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div class="md-form mb-0">
                            <button class="btn light-blue darken-2 text-white btn-block"
                                    type="submit">@lang('Save')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
