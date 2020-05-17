<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @section('title')
            Admin panel - {{ config('app.name', 'Sanium') }}
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

                $(".button-collapse").sideNav();

                const sideNavScrollbar = document.querySelector('.custom-scrollbar');
                const ps = new PerfectScrollbar(sideNavScrollbar);
            });
        })(window, document);
    </script>
    @yield('javascript')

</head>

<body class="grey lighten-4">
    <nav class="navbar navbar-expand light-blue navbar-dark">
        <div class="container-fluid d-flex justify-content-start px-xl-5">
            <!-- SideNav slide-out button -->
            <a href="#" data-activates="slide-out" class="text-white button-collapse mr-3"><i
                    class="fas fa-bars"></i></a>
            <a class="navbar-brand" href="{{ route('welcome') }}">Sanium</a>
        </div>
    </nav>
    <!-- Sidebar navigation -->
    <div id="slide-out" class="side-nav side-nav-light white white-skin">
        <ul class="custom-scrollbar">
            <!-- Logo -->
            <li>
                <div class="logo-wrapper d-flex justify-content-center align-items-center">
                    <h2 class="display-4 text-dark">Sanium</h2>
                </div>
            </li>
            <!--/. Logo -->
            <!--Social-->
            <li>
                <ul class="social">
                    <li>
                        <a href="{{ route('logout') }}" class="" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();" title="{{ __('Logout') }}">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>


            <!--/Social-->
            <!-- Side navigation links -->
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="collapsible-header waves-effect">
                            <i class="fas fa-tachometer-alt"></i>Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.properties') }}" class="collapsible-header waves-effect">
                            <i class="fas fa-database"></i>
                            Offer properties
                        </a>
                    </li>
                    <lwi>
                        <a href="{{ route('admin.users.index') }}" class="collapsible-header waves-effect">
                            <i class="fas fa-users"></i>
                            All users
                        </a>
                    </lwi>
                </ul>
            </li>
            <!--/. Side navigation links -->
        </ul>
        <div class="sidenav-bg"></div>
    </div>
    <!--/. Sidebar navigation -->

    <main>
        @yield('admin.content')
    </main>
</body>
</html>


