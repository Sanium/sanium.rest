<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @section('title')
            {{ config('app.name', 'Sanium') }}
        @show
    </title>

    <!-- Styles -->
    @include('imports.css')

    <!-- Scripts -->
    @include('imports.js')

</head>
<body>
@yield('main.content')
</body>
</html>

