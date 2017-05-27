@extends('jellies::realm.realmBase')

@section('main')

    <h1>
        <span class="fa fa-globe"></span> {{ $model->name }}
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::realm.attribute.materials') }}</strong></div>
        <div class="panel-body">
            @if(isset($model->zones) && count($model->zones))
                @include('jellies::zone.list.zoneList', ['models' => $model->zones])
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
