@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row center">
            <div class="col m12">
                <div class="card">
                    <h4>{{ __('Edit profile') }}</h4>
                    <div class="card-content">
                        <form action="{{ route('employer.update', $employer) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name"  value="{{ old('name') ?? $employer->name  }}" required>
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
