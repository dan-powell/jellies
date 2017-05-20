@extends('jellies::user.userBase')

@section('main')

    <h1>
        <span class="fa fa-user"></span> {{ $model->name }}
        <small>
            {{ trans('jellies::user.attribute.points') }} {{ $model->points }}
        </small>
    </h1>


    <div class="panel panel-default">
        @if(isset($model->minions) && count($model->minions))
            @include('jellies::minion.list.minionList', ['minions' => $model->minions])
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
        <span class="fa fa-info-circle"></span> {{ trans('jellies::user.show.help') }}
    </div>
@endsection
