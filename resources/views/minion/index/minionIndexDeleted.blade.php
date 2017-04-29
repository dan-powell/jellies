@extends('jellies::minion.minionBase')

@section('main')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="box-title">{{ trans('jellies::minion.indexdeleted.title') }}</h3>
        </div>
        @if(isset($models) && count($models))
            @include('jellies::minion.list.minionList', ['minions' => $models])
        @else
            <div class="panel-body">
                <p>{{ trans('jellies::minion.indexdeleted.none') }}</p>
            </div>
        @endif
    </div>
@endsection
