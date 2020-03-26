@extends('layouts.main')

@section('main.content')
    @include('components.navbar')
    <main>
        @yield('content')
    </main>
@endsection


