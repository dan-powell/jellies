@extends('jellies::type.typeBase')

@section('main')

    <h1>
        <span class="game-icon game-icon-slime"></span> {{ $model->name }}
        <small>
            {{ trans('jellies::type.attribute.level') }}
        </small>
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::type.attribute.effective') }}</strong></div>
        <div class="panel-body">
            @if(isset($model->effective) && count($model->effective))
                @include('jellies::type.list.typeList', ['models' => $model->effective])
            @endif
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::type.attribute.ineffective') }}</strong></div>
        <div class="panel-body">
            @if(isset($model->ineffective) && count($model->ineffective))
                @include('jellies::type.list.typeList', ['models' => $model->ineffective])
            @endif
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::type.attribute.modifiers') }}</strong></div>
        <div class="panel-body">
            @if(isset($model->modifiers) && count($model->modifiers))
                @include('jellies::modifier.list.modifierList', ['models' => $model->modifiers])
            @endif
        </div>
    </div>



@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::type.show.help') }}
    </div>
@endsection
