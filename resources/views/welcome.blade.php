@extends('layouts.app')

@section('main.content')
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
