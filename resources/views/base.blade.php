<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/jellies/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/jellies/css/game-icons.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        ]) !!};
        </script>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Jellies') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="{{ route('dashboard') }}">Dashboard <span class="sr-only">(current)</span></a></li>
                            <li class="dropdown">
                                <a href="{{ route('minion.index') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Minions <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('minion.index') }}">View all minions</a></li>
                                    <li><a href="{{ route('minion.deleted') }}">View dead minions</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Incursions <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('incursion.index') }}">View all incursions</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ route('incursion.create') }}">Create new incursion</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Enemies <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('enemy.index') }}">View all enemies</a></li>
                                </ul>
                            </li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @else
                                <li class="dropdown">
                                    <a href="#">
                                        <span class="fa fa-star"></span> {{ auth()->user()->points }}
                                    </a>
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        <span class="fa fa-envelope"></span>
                                        @if(isset($messages)) {{ count($messages) }}@endif
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('message.index') }}">View all messages</a></li>
                                        <li role="separator" class="divider"></li>
                                        @if(isset($messages) && count($messages))
                                            @foreach($messages as $message)
                                                <li>
                                                    <a href="{{ route('message.show', $message->id) }}">
                                                    {{ $message->subject }}</a>
                                                </li>
                                            @endforeach
                                        @else
                                            <li>No messages</li>
                                        @endif
                                    </ul>
                                </li>


                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">

                {!! Notification::showAll() !!}

                @if(isset($errors) && count($errors->all()))
                    <div class="alert alert-warning">
                        <p><strong>The following errors occured:</strong></p>
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>

        <div class="container">
            <div class="row">
                @hasSection('sidebar')
                    <div class="col-sm-4">
                        <div class="well">
                            @yield('sidebar')
                        </div>
                    </div>
                    <div class="col-sm-8">
                        @yield('main')
                    </div>
                @else
                    <div class="col-sm-8 col-sm-offset-2">
                        @yield('main')
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
