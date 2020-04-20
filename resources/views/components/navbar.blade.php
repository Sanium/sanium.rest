@php
    $guest_links = [
        ['route' => route('login'), 'name' => __('Login')],
        ['route' => route('register'), 'name' => __('Register')],
    ];
    $admin_links = [
        ['route' => route('admin.dashboard'), 'name' => __('Admin panel'), 'icon' => 'developer_board'],
    ];
    if (!auth()->guest()) {
        $employer_links = [
            ['route' => route('home'), 'name' => __('Dashboard'), 'icon' => 'home'],
            ['route' => route('employer.edit', auth()->user()->profile()->first()), 'name' => __('Update profile'), 'icon' => 'settings'],
        ];
    }
@endphp
<!--Navbar-->
<nav class="navbar navbar-expand-sm navbar-dark light-blue" role="navigation">
    <div class="container">
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $link['route'] }}">{{ $link['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <span class="navbar-text ml-auto">Welcome {{ auth()->user()->profile()->first()->name }}</span>
                <ul class="navbar-nav">
                    @if( auth()->user()->isEmployer() )
                        @foreach( $employer_links as $link)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $link['route'] }}">{{ $link['name'] }}</a>
                            </li>
                        @endforeach
                    @endif
                    @if( auth()->user()->isAdmin() )
                        @foreach( $admin_links as $link)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $link['route'] }}">{{ $link['name'] }}</a>
                            </li>
                        @endforeach
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            @endguest
        </div>
    </div>
</nav>
