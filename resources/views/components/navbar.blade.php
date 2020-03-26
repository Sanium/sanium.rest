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
<nav class="amber" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="/" class="brand-logo">{{ config('app.name') }}</a>
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
                    <a class="dropdown-trigger no-autoinit" href="#"
                       data-target='dropdown1'>{{ Auth::user()->name }}</a>
                </li>
                <ul id="dropdown1" class='dropdown-content'>
                    @if( auth()->user()->isEmployer() )
                        @foreach( $employer_links as $link)
                            <li>
                                <a class="black-text" href="{{ $link['route'] }}"><i
                                        class="material-icons">{{ $link['icon'] }}</i>{{ $link['name'] }}</a>
                            </li>
                        @endforeach
                    @endif
                    @if( auth()->user()->isAdmin() )
                        @foreach( $admin_links as $link)
                            <li>
                                <a class="black-text" href="{{ $link['route'] }}"><i
                                        class="material-icons">{{ $link['icon'] }}</i>{{ $link['name'] }}</a>
                            </li>
                        @endforeach
                    @endif
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
                @if( auth()->user()->isEmployer() )
                    @foreach( $employer_links as $link)
                        <li>
                            <a class="black-text" href="{{ $link['route'] }}"><i
                                    class="material-icons">{{ $link['icon'] }}</i>{{ $link['name'] }}</a>
                        </li>
                    @endforeach
                @endif
                @if( auth()->user()->isAdmin() )
                    @foreach( $admin_links as $link)
                        <li>
                            <a class="black-text" href="{{ $link['route'] }}"><i
                                    class="material-icons">{{ $link['icon'] }}</i>{{ $link['name'] }}</a>
                        </li>
                    @endforeach
                @endif
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
