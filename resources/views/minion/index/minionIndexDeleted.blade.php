@extends('jellies::minion.minionBase')

@section('main')
    <h1>{{ trans('jellies::minion.indexdeleted.title') }}</h1>
    <div class="panel panel-default">
        @if(isset($models) && count($models))
            @include('jellies::minion.list.minionList', ['minions' => $models])
        @else
            <div class="panel-body">
                <p>{{ trans('jellies::minion.indexdeleted.empty') }}</p>
            </div>
        @endif
    </div>
@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::minion.indexdeleted.help') }}
    </div>
    <div class="alert alert-danger">
        <span class="fa fa-exclamation-circle"></span> {{ trans('jellies::minion.indexdeleted.danger') }}
    </div>
@endsection
