@extends('jellies::layout.slim.layoutSlim')

@section('main')

    <h2>
        {{ $model->firstname }}
        {{ isset($model->nickname) ? '"'.$model->nickname.'"' : '' }}
        {{ $model->lastname }}
    </h2>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::minion.level') }} {{ $model->level }}</strong></div>
    </div>

    @if($model->active)
        <div class="panel panel-success">
            <div class="panel-heading"><strong>{{ trans('jellies::minion.active_message') }} </strong></div>
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::minion.stats') }}</strong></div>
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

    <div class="panel panel-default">
        <div class="panel-heading"><strong>Health</strong></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-2 text-right"><strong>HP</strong></div>
                <div class="col-xs-7">
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger"
                            role="progressbar"
                            aria-valuenow="{{ $stat['value'] }}"
                            aria-valuemin="0"
                            aria-valuemax="{{ $model->health }}"
                            style="width: {{ $model->hp / $model->health * 100 }}%;">
                            {{ $model->hp }} / {{ $model->health }}
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    @if($model->hp == $model->health)
                        <strong class="badge bg-red">Max</strong>
                    @endif
                    @if($model->hp <= 0)
                        <strong class="badge bg-red">DEAD</strong>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <a href="{{ route('minion.edit', $model->id) }}" class="btn btn-success">
        Edit Minion
    </a>


    @if($model->hp < $model->health)
        {!! Form::open(['route' => ['minion.heal', $model->id], 'method' => 'post']) !!}
            <button type="submit" class="btn btn-primary">
                {{ trans('jellies::minion.actions.heal') }} ({{ $model->health - $model->hp }} {{ trans_choice('jellies::game.point', $model->health - $model->hp) }})
            </button>
        {!! Form::close() !!}
    @endif

@endsection
