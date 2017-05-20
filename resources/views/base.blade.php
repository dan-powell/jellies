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
                            <li class=""><a href="{{ route('dashboard') }}" data-toggle="tooltip" data-placement="bottom" title="{{ trans('jellies::dashboard.show.tooltip') }}">Dashboard</a></li>
                            <li class=""><a href="{{ route('minion.index') }}" data-toggle="tooltip" data-placement="bottom" title="{{ trans('jellies::minion.index.tooltip') }}">{{ trans('jellies::minion.title') }}</a></li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" title="{{ trans('jellies::game.point.title') }}">
                                    {{ trans('jellies::user.title') }}
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('user.index') }}">
                                            <strong>{{ trans('jellies::user.index.title') }}</strong>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="{{ route('attack.index') }}" data-toggle="tooltip" data-placement="bottom" title="{{ trans('jellies::attack.index.tooltip') }}">{{ trans('jellies::attack.title') }}</a>
                                    </li>
                                    <li class="">
                                        <a href="{{ route('defence.index') }}" data-toggle="tooltip" data-placement="bottom" title="{{ trans('jellies::defence.index.tooltip') }}">{{ trans('jellies::defence.title') }}</a>
                                    </li>
                                </ul>
                            </li>

                            <li class=""><a href="{{ route('type.index') }}" data-toggle="tooltip" data-placement="bottom" title="{{ trans('jellies::type.index.tooltip') }}">{{ trans('jellies::type.title') }}</a></li>
                            <li class=""><a href="{{ route('realm.index') }}" data-toggle="tooltip" data-placement="bottom" title="{{ trans('jellies::realm.index.tooltip') }}">{{ trans('jellies::realm.title') }}</a></li>
                            <li class=""><a href="{{ route('incursion.index') }}" data-toggle="tooltip" data-placement="bottom" title="{{ trans('jellies::incursion.index.tooltip') }}">{{ trans('jellies::incursion.title') }}</a></li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" title="{{ trans('jellies::game.point.title') }}">
                                        <span class="fa fa-tint"></span> {{ auth()->user()->types->sum('pivot.quantity') }}
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ route('user.types') }}">
                                                <strong>{{ trans('jellies::user.types.tooltip') }}</strong>
                                            </a>
                                        </li>
                                        @foreach(auth()->user()->types as $type)
                                            <li>
                                                <a href="{{ route('type.show', $type->id) }}">
                                                    {{ $type->name }} - {{ $type->pivot->quantity }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="">
                                    <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('jellies::user.action.title') }}">
                                        <span class="fa fa-star"></span> {{ auth()->user()->actions }}
                                    </a>
                                </li>

                                <li class="" data-toggle="tooltip" data-placement="bottom" title="{{ trans('jellies::message.index.tooltip') }}">
                                    <a href="{{ route('message.index') }}" class="">
                                        <span class="fa fa-envelope"></span>
                                        @if(isset($messages)) {{ count($messages->where('read', false)) }}@endif
                                    </a>
                                </li>


                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
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

                        @yield('help')

                    </div>
                    <div class="col-sm-8">
                        @yield('main')
                    </div>
                @else
                    <div class="col-sm-12">
                        @yield('help')

                        @yield('main')
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="popover"]').popover();
        })
    </script>

</body>
</html>
