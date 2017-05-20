@extends('jellies::base')

@section('main')

    <section class="content">

        <div class="row">
            <div class="col-sm-4">
                <div class="alert alert-info">
                    <a href="{{ route('minion.index') }}" class="alert-link">
                        <i class="game-icon game-icon-slime"></i>
                        {{ count($minions) }} {{ trans_choice('jellies::minion.plural', count($minions)) }}
                    </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="alert alert-success">
                    <a href="{{ route('incursion.index') }}" class="alert-link">
                        <i class="game-icon game-icon-swordman"></i>
                        {{ count($incursions) }} {{ trans_choice('jellies::incursion.plural', count($incursions)) }}
                    </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="alert alert-danger">
                    <i class="fa fa-star"></i>
                     {{ auth()->user()->points }} {{ trans_choice('jellies::game.point.plural', auth()->user()->points) }}
                </div>
            </div>
        </div>

        <div class="jumbotron">
            <h1>{{ trans('jellies::dashboard.welcome.title', ['name' => auth()->user()->name]) }}</h1>
            <p>{{ trans('jellies::dashboard.welcome.help') }}</p>
            <p>
                <a class="btn btn-primary btn-lg" href="{{ route('minion.create') }}" role="button">{{ trans('jellies::minion.create.action') }}</a>
                <a class="btn btn-success btn-lg" href="{{ route('incursion.create') }}" role="button">{{ trans('jellies::incursion.create.action') }}</a>
            </p>
        </div>

        <div class="row">

            <div class="col-sm-6">

                @if(count($minions))

                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('jellies::minion.index.title') }}</h3>
                        </div>
                        @include('jellies::minion.list.minionList', ['minions' => $minions])
                    </div>

                @else

                    <div class="alert alert-info">
                        {{ trans('jellies::minion.index.empty') }}
                    </div>

                @endif

            </div>

            <div class="col-sm-6">

                @if(count($incursions_waiting))
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('jellies::incursion.labels.waiting') }}</h3>
                        </div>
                        @include('jellies::incursion.list.incursionList', ['incursions' => $incursions_waiting])
                    </div>
                @endif

                @if(count($incursions))
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('jellies::incursion.index.title') }}</h3>
                        </div>
                        @include('jellies::incursion.list.incursionList', ['incursions' => $incursions])
                    </div>
                @endif

            </div>
        </div>

    </section>

@endsection

@section('sidebar')

    <h3 class="">{{ trans('jellies::leaderboard.title') }}</h3>

    @include('jellies::user.list.userList', ['users' => $leaderboard])

@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::dashboard.show.help') }}
    </div>
@endsection
