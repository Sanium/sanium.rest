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

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script defer>
        (function (window, document) {
            document.addEventListener('DOMContentLoaded', function () {
                @if ( session('status') )
                M.toast({html: "{{ session('status') }}"});
                @endif
            });
        })(window, document);
    </script>
    @yield('javascript')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body class="grey lighten-4">
    @include('components.navbar')
    <main style="margin: 2rem 0;">
        @yield('content')
    </main>
</body>
</html>


