@extends('jellies::realm.realmBase')

@section('main')

    <h1>
        <span class="game-icon game-icon-night-sky"></span> {{ $model->name }}
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::realm.attribute.types') }}</strong></div>
        <div class="panel-body">
            @if(isset($model->types) && count($model->types))
                @include('jellies::type.list.typeList', ['models' => $model->types])
            @endif
        </div>
    </div>

@endsection


@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::realm.show.help') }}
    </div>
@endsection
