@extends('jellies::base')

@section('main')

    <section class="content">

        <div class="row">
            <div class="col-sm-4">
                <div class="alert alert-success">
                    <i class="game-icon game-icon-swordman"></i>
                    {{ count($incursions) }} {{ trans_choice('jellies::incursion.plural', count($incursions)) }}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="alert alert-info">
                    <i class="game-icon game-icon-slime"></i>
                    {{ count($minions) }} {{ trans_choice('jellies::minion.plural', count($minions)) }}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="alert alert-danger">
                    <i class="fa fa-star"></i>
                     {{ auth()->user()->points }} {{ trans_choice('jellies::game.points', auth()->user()->points) }}
                </div>
            </div>
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
                        {{ trans('jellies::minion.index.help') }}
                    </div>

                @endif

            </div>

            <div class="col-sm-6">

                @if(count($minions))

                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ trans('jellies::incursion.index.title') }}</h3>
                        </div>
                        @include('jellies::incursion.list.incursionList', ['incursions' => $incursions])
                    </div>

                @else

                    <div class="alert alert-success">
                        {{ trans('jellies::incursion.index.help') }}
                    </div>

                @endif

            </div>

        </div>


    </section>

@endsection

@section('sidebar')

    <h3 class="">{{ trans('jellies::leaderboard.title') }}</h3>

    <table class="table">
        <tr>
            <th>{{ trans('jellies::leaderboard.attribute.rank') }}</th>
            <th>{{ trans('jellies::leaderboard.attribute.name') }}</th>
            <th>{{ trans('jellies::leaderboard.attribute.points') }}</th>
        </tr>
        @foreach ($leaderboard as $key => $user)
            <tr>
                <td>
                    {{ $key }}
                </td>
                <td>
                    <span class="fa fa-user"></span> {{ $user->name }}
                </td>
                <td>
                    <span class="badge bg-blue">{{ $user->points }}</span>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
