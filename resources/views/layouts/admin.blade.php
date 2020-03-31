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
        <div class="container d-flex justify-content-start">
            <!-- SideNav slide-out button -->
            <a href="#" data-activates="slide-out" class="text-white button-collapse mr-3"><i
                    class="fas fa-bars"></i></a>
            <a class="navbar-brand" href="{{ route('welcome') }}">Sanium</a>
        </div>
    </nav>
    <!-- Sidebar navigation -->
    <div id="slide-out" class="side-nav light-blue">
        <ul class="custom-scrollbar">
            <!-- Logo -->
            <li>
                <div class="logo-wrapper d-flex justify-content-center align-items-center">
                    <h2 class="display-4">Sanium</h2>
                </div>
            </li>
            <!--/. Logo -->


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
                            <i class="fas fa-tachometer-alt"></i>
                            Offer properties
                        </a>
                    </li>

                </ul>
            </li>
            <!--/. Side navigation links -->
        </ul>
        <div class="sidenav-bg rgba-blue-strong"></div>
    </div>
    <!--/. Sidebar navigation -->

    <main>
        @yield('content')
    </main>
@endsection


