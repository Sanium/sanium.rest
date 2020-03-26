@extends('layouts.main')

@section('title')
    Admin Dashboard - @parent
@endsection

@section('main.content')
    <header style="margin-left: 300px;">
        <nav class="amber">
            <div class="nav-wrapper row">
                <div class="col s12">
                    <a href="{{ route('welcome') }}" class="brand-logo">{{ config('app.name') }}</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li>
                            <a class="dropdown-trigger no-autoinit" href="#"
                               data-target='dropdown1'>{{ auth()->user()->name }}</a>
                        </li>
                    </ul>
                    <ul id="dropdown1" class='dropdown-content'>
                        <li>
                            <a class="black-text" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="material-icons">exit_to_app</i>{{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <ul class="sidenav sidenav-fixed">
            <li class="admin_logo">Admin panel</li>
            <li><a href="{{ route('admin.dashboard') }}"><i class="material-icons">developer_board</i>Dashboard</a></li>
            <li><a href="{{ route('admin.properties') }}"><i class="material-icons">developer_mode</i>Offers properties</a></li>
        </ul>
    </header>
    <main style="margin-left: 300px;">
        @yield('content')
    </main>
@endsection


