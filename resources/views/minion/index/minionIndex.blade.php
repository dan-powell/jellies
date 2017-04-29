@extends('jellies::minion.minionBase')

@section('main')
    <h1>{{ trans('jellies::minion.index.title') }}</h1>

    <div class="panel panel-default">
        @if(isset($models) && count($models))
            @include('jellies::minion.list.minionList', ['minions' => $models])
        @else
            <div class="panel-body">
                <p>{{ trans('jellies::minion.indexdeleted.none') }}</p>
            </div>
        @endif
    </div>
@endsection
