@php
    $links = [];
    if (auth()->guest()) {
        $links = [
            ['route' => route('login'), 'name' => __('Login')],
            ['route' => route('register'), 'name' => __('Register')],
        ];
    } else {
        if (auth()->user()->isEmployer()) {
            $links = [
                ['route' => route('home'), 'name' => __('Dashboard')],
                ['route' => route('employer.edit', auth()->user()->profile()->first() ?? 0), 'name' => __('Update profile')],
            ];
        }
        if (auth()->user()->isClient()) {
            $links = [
                ['route' => route('home'), 'name' => __('Dashboard')],
                ['route' => route('client.edit', auth()->user()->profile()->first() ?? 0), 'name' => __('Update profile')],
            ];
        }
        if (auth()->user()->isAdmin()) {
            $links = [
                ['route' => route('admin.dashboard'), 'name' => __('Admin panel')],
            ];
        }
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
                    @foreach( $links as $link )
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $link['route'] }}">{{ $link['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <span class="navbar-text ml-auto">{{ __('Welcome, :name', ['name'=> auth()->user()->profile()->first()->name]) }}</span>
                <ul class="navbar-nav">
                    @foreach( $links as $link)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $link['route'] }}">{{ $link['name'] }}</a>
                        </li>
                    @endforeach
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
