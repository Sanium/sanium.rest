@extends('layouts.main')

@section('title')
    Admin Dashboard - @parent
@endsection

@section('javascript')
    <script defer>
        (function (window, document) {
            window.addEventListener('load', () => {
                $(".button-collapse").sideNav();

                var sideNavScrollbar = document.querySelector('.custom-scrollbar');
                var ps = new PerfectScrollbar(sideNavScrollbar);
            })
        })(window, document);
    </script>
@endsection

@section('main.content')
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
                        <a href="{{ route('admin.employers.index') }}" class="collapsible-header waves-effect">
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
        @yield('content')
    </main>
@endsection


