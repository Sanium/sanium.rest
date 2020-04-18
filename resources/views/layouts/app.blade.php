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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script defer>
        (function (window, document) {
            window.addEventListener('load', function () {
                @if ( session('status') )
                    toastr["info"]("{{ session('status') }}");
                @endif
            });
        })(window, document);
    </script>
    @yield('javascript')

</head>
<body class="grey lighten-4">
    @include('components.navbar')
    @yield('content')
</body>
</html>


