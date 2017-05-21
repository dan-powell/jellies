@extends('jellies::type.typeBase')

@section('main')

    <h1>
        <span class="fa fa-tint"></span> {{ $model->name }}
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::type.attribute.effective') }}</strong></div>
        <div class="list-group">
            @if(isset($model->effective) && count($model->effective))
                @foreach($model->effective as $key => $effective)
                    <a href="{{ route('type.show', $key) }}" class="list-group-item">{{ $effective->name }}</a>
                @endforeach
            @endif
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::type.attribute.ineffective') }}</strong></div>
        <div class="list-group">
            @if(isset($model->ineffective) && count($model->ineffective))
                @foreach($model->ineffective as $key => $ineffective)
                    <a href="{{ route('type.show', $key) }}" class="list-group-item">{{ $ineffective->name }}</a>
                @endforeach
            @endif
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::type.attribute.modifiers') }}</strong></div>
        @if(isset($model->modifiers) && count($model->modifiers))
            @include('jellies::modifier.list.modifierList', ['models' => $model->modifiers])
        @endif
    </div>



@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::type.show.help') }}
    </div>
@endsection
