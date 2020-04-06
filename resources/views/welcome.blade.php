@extends('layouts.app')

@section('javascript')
    {{--    @include('imports.js')--}}
@endsection

@section('styles')
    {{--    @include('imports.css')--}}
@endsection

@section('content')
    <app-root></app-root>
    <script>
        window.links = [
            {
                'name': 'Login',
                'url': 'localhost/login'
            },
            {
                'name': 'Register',
                'url': 'localhost/register'
            },
        ];
    </script>
@endsection
