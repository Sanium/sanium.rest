@extends('layouts.app')

@section('content')
    <form action="{{ route('employer.update', $employer) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') ?? $employer->name  }}">
        <button type="submit">Submit</button>
    </form>
@endsection
