@extends('layouts.app')

@section('content')
    <form action="{{ route('offers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="input-field col s12">
            <label for="experience">Experience</label>
            <select name="exp_id" id="experience">
                @foreach($experiences as $experience)
                    <option value="{{ $experience->id }}">{{ $experience->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-field col s12">
            <label for="employment">Employment</label>
            <select name="exp_id" id="employment">
                @foreach($employments as $employment)
                    <option value="{{ $employment->id }}">{{ $employment->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-field col s12">
            <label for="currency">Currency</label>
            <select name="exp_id" id="currency">
                @foreach($currencies as $currency)
                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-field col s12">
            <label for="technologies">Technologies</label>
            <select name="exp_id" id="technologies">
                @foreach($technologies as $technologie)
                    <option value="{{ $technologie->id }}">{{ $technologie->name }}</option>
                @endforeach
            </select>
        </div>

    </form>
@endsection
