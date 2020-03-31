@php
    $guest_links = [
        ['route' => route('login'), 'name' => __('Login')],
        ['route' => route('register'), 'name' => __('Register')],
    ];
    $admin_links = [
        ['route' => route('admin.dashboard'), 'name' => __('Admin panel'), 'icon' => 'developer_board'],
    ];
    if (!!!auth()->guest() && null !== auth()->user()->profile()->first()) {
        $employer_links = [
            ['route' => route('home'), 'name' => __('Dashboard'), 'icon' => 'home'],
            ['route' => route('employer.edit', auth()->user()->profile()->first()), 'name' => __('Update profile'), 'icon' => 'settings'],
        ];
    } else {
        $employer_links = [
            ['route' => route('employer.create'), 'name' => __('Create profile'), 'icon' => 'account_circle'],
        ];
    }
@endphp
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark amber" role="navigation">

    <!-- Navbar brand -->
    <a id="logo-container" href="/" class="navbar-brand">{{ config('app.name') }}</a>

    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavigation"
            aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="mainNavigation">
        @guest
            <ul class="navbar-nav ml-auto">
                @foreach( $guest_links as $link )
                    <li class="nav-item"><a class="nav-link" href="{{ $link['route'] }}">{{ $link['name'] }}</a></li>
                @endforeach
            </ul>
        @else
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                        @if( auth()->user()->isEmployer() )
                            @foreach( $employer_links as $link)
                                <a class="dropdown-item" href="{{ $link['route'] }}">{{ $link['name'] }}</a>
                            @endforeach
                        @endif
                        @if( auth()->user()->isAdmin() )
                            @foreach( $admin_links as $link)
                                <a class="dropdown-item" href="{{ $link['route'] }}">{{ $link['name'] }}</a>
                            @endforeach
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        @endguest
    </div>
</nav>
