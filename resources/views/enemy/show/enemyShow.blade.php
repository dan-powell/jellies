@extends('jellies::enemy.enemyBase')

@section('main')

    <h1>
        <span class="game-icon game-icon-skull"></span> {{ $model->name }}
        <small>
            {{ trans('jellies::enemy.attribute.level') }} {{ $model->level }}
        </small>
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::enemy.attribute.stats') }}</strong></div>
        <div class="panel-body">
            <div class="row">
                @foreach($model->stats as $key => $stat)
                    <div class="col-xs-4 text-right">
                        {{ trans('jellies::enemy.attribute.' . $key) }}
                        <span class="{{ config('jellies.ui.stat_icons.' . $key) }}"></span>
                    </div>
                    <div class="col-xs-8">
                        <div class="progress">
                            <div class="progress-bar"
                            role="progressbar"
                            aria-valuenow="{{ $stat }}"
                            aria-valuemin="0"
                            aria-valuemax="100"
                            style="width: {{ $stat / $model->max_stat_value * 100 }}%; min-width: 10%;">
                                {{ $stat }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection




@section('main')

    <h2>
        {{ $model->name }}
    </h2>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::enemy.level') }} {{ $model->level }}</strong></div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::enemy.stats') }}</strong></div>
        <div class="panel-body">
            <div class="row">
                @foreach($model->stats as $key => $stat)
                <div class="col-xs-4 text-right">
                    {{ trans('jellies::minion.' . $key) }}
                    <span class="{{ config('jellies.ui.stat_icons.' . $key) }}"></span>
                </div>
                <div class="col-xs-8">
                    <div class="progress">
                        <div class="progress-bar"
                            role="progressbar"
                            aria-valuenow="{{ $stat }}"
                            aria-valuemin="0"
                            aria-valuemax="100"
                            style="width: {{ $stat / $model->max_stat_value * 100 }}%; min-width: 10%;">
                            {{ $stat }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
