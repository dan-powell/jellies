@extends('jellies::enemy.enemyBase')

@section('main')
    <h1>
        {{ trans('jellies::enemy.title') }}
    </h1>
    <div class="panel panel-default">
        @if(isset($models) && count($models))
            @include('jellies::enemy.list.enemyList', ['enemies' => $models])
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
        <span class="fa fa-info-circle"></span> {{ trans('jellies::enemy.index.help') }}
    </div>
@endsection
