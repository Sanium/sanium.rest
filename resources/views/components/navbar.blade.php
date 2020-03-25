@php
$guest_links = [
    ['route' => route('login'), 'name' => __('Login')],
    ['route' => route('register'), 'name' => __('Register')],
];
@endphp

<nav class="amber" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="/" class="brand-logo">{{config('app.name')}}</a>
        @guest
            <ul class="right hide-on-med-and-down">
                @foreach( $guest_links as $link )
                    <li><a href="{{ $link['route'] }}">{{ $link['name'] }}</a></li>
                @endforeach
            </ul>
            <ul id="nav-mobile" class="sidenav">
                @foreach( $guest_links as $link )
                    <li><a href="{{ $link['route'] }}">{{ $link['name'] }}</a></li>
                @endforeach
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
                        <a class="black-text" href="{{ route('employer.edit', Auth::user()->profile()->first()) }}"><i class="material-icons">settings</i>Update profile</a>
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
                    <a class="black-text" href="{{ route('home') }}"><i class="material-icons">home</i>Dashboard</a>
                </li>
                <li>
                    <a class="black-text" href="{{ route('employer.edit', Auth::user()->profile()->first()) }}"><i class="material-icons">settings</i>Update profile</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form-mobile').submit();">
                        <i class="material-icons">exit_to_app</i>{{ __('Logout') }}
                    </a>

                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        @endguest
    </div>
</nav>
