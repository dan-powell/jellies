@extends('jellies::realm.realmBase')

@section('main')
    <h1>
        {{ trans('jellies::realm.title') }}
    </h1>
    <div class="panel panel-default">
        @if(isset($models) && count($models))
            @include('jellies::realm.list.realmList', ['realms' => $models])
        @else
            <div class="panel-body">
                <p>{{ trans('jellies::realm.index.empty') }}</p>
            </div>
        @endif
    </div>
@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::realm.index.help') }}
    </div>
@endsection
