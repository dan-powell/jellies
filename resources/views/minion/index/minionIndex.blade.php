@extends('jellies::minion.minionBase')

@section('main')
    <h1>{{ trans('jellies::minion.index.title') }}</h1>

    <div class="panel panel-default">
        @if(isset($models) && count($models))
            @include('jellies::minion.list.minionList', ['minions' => $models])
        @else
            <div class="panel-body">
                <p>{{ trans('jellies::minion.index.empty') }}</p>
            </div>
        @endif
    </div>
@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::minion.index.help') }}
    </div>
@endsection
