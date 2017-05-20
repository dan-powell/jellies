@extends('jellies::realm.realmBase')

@section('main')

    <h1>
        <span class="fa fa-cloud"></span> {{ $model->name }}
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('jellies::zone.attribute.size') }}</h3>
        </div>
        <div class="panel-body">
            <p>{{ $model->size }} {{ trans('jellies::zone.attribute.size') }}
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('jellies::enemy.title') }}</h3>
        </div>
        @if(isset($model->enemies) && count($model->enemies))
            @include('jellies::enemy.list.enemyList', ['models' => $model->enemies])
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
        <span class="fa fa-info-circle"></span> {{ trans('jellies::zone.show.help') }}
    </div>
@endsection
