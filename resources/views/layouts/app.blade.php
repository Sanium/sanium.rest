<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="amber" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="/" class="brand-logo">{{config('app.name')}}</a>
            @guest
                <ul class="right hide-on-med-and-down">
                    <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                </ul>
                <ul id="nav-mobile" class="sidenav">
                    <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                </ul>
                <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            @else
                <ul class="right hide-on-med-and-down">
                    <li>

                    </li>
                    <li><a class="dropdown-trigger no-autoinit"  href="#" data-target='dropdown1' >{{ Auth::user()->name }}</a></li>

                        <ul id="dropdown1" class='dropdown-content'>
                            <li>
                                <a class="black-text" href="{{ route('home') }}"><i class="material-icons">home</i>Dashboard</a>
                            </li>
                            <li>
                                <a class="black-text" href="{{ route('employer.edit', Auth::user()->profile()->first()) }}"><i class="material-icons">settings</i>Edit profile</a>
                            </li>
                            <li>
                                <a class="black-text" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                                    <i class="material-icons">exit_to_app</i>{{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>

                </ul>
                <ul id="nav-mobile" class="sidenav">
                    <li>
                        <a class="black-text" href="{{ route('employer.show', Auth::user()->profile()->first()) }}"><i class="material-icons">person</i>Profile</a>
                    </li>
                    <li>
                        <a class="black-text" href="{{ route('employer.edit', Auth::user()->profile()->first()) }}"><i class="material-icons">settings</i>Edit profile</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="material-icons">exit_to_app</i>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
                <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            @endguest
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
    <script>
        (function(window, document){
            document.addEventListener('DOMContentLoaded', function () {
                let status = "";
                @if ( session('status') )
                    status = "{{ session('status') }}";
                @endif
                if ("" !== status) {
                    M.toast({html: status})
                }
            });
        })(window, document);
    </script>
</body>
</html>
