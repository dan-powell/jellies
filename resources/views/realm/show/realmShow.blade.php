@extends('jellies::realm.realmBase')

@section('main')

    <h1>
        <span class="game-icon game-icon-night-sky"></span> {{ $model->name }}
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('jellies::zone.title') }}</h3>
        </div>
        @if(isset($model->zones) && count($model->zones))
            @include('jellies::zone.list.zoneList', ['zones' => $model->zones])
        @else
            <div class="panel-body">
                <p>{{ trans('jellies::zone.index.empty') }}</p>
            </div>
        @endif
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('jellies::enemy.title') }}</h3>
        </div>
        @if(isset($model->enemies) && count($model->enemies))
            @include('jellies::enemy.list.enemyList', ['enemies' => $model->enemies])
        @else
            <div class="panel-body">
                <p>{{ trans('jellies::enemy.index.empty') }}</p>
            </div>
        @endif
    </div>

@endsection


@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::realm.show.help') }}
    </div>
@endsection
