@extends('jellies::minion.minionBase')

@section('main')

    <h1>
        <span class="game-icon game-icon-slime"></span> {{ $model->name }}
        <small>
            {{ trans('jellies::minion.attribute.level') }} {{ $model->level }}
        </small>
    </h1>

    @if($model->active === false && $model->alive)
        <a href="{{ route('minion.edit', $model->id) }}" class="btn btn-info">
            {{ trans('jellies::minion.edit.action') }}
        </a>
    @endif

    @if($model->hp < $model->health)
        {!! Form::open(['route' => ['minion.heal', $model->id], 'method' => 'post']) !!}
        <button type="submit" class="btn btn-danger">
            {{ trans('jellies::minion.heal.action') }}
        </button>
        {!! Form::close() !!}
    @endif

    <hr/>

    @if($model->active)
        <div class="alert alert-info"><strong><span class="game-icon game-icon-swordman fa-lg"></span> {{ trans('jellies::minion.show.active') }} </strong></div>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::minion.attribute.hp') }}</strong></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-10">
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger"
                        role="progressbar"
                        aria-valuenow="{{ $model->hp }}"
                        aria-valuemin="0"
                        aria-valuemax="{{ $model->health }}"
                        style="width: {{ $model->hp / $model->health * 100 }}%;">
                            {{ $model->hp }} / {{ $model->health }}
                    </div>
                    </div>
                </div>
                <div class="col-xs-2">
                    @if($model->hp == $model->health)
                        <strong class="badge">Max</strong>
                    @endif
                    @if($model->hp <= 0)
                        <strong class="badge">Dead</strong>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::minion.attribute.stats') }}</strong></div>
        <div class="panel-body">
            <div class="row">
                @foreach($model->stats as $key => $stat)
                    <div class="col-xs-4 text-right">
                        {{ trans('jellies::minion.attribute.' . $key) }}
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

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::minion.show.help') }}
    </div>
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::minion.show.help') }}
    </div>
@endsection
