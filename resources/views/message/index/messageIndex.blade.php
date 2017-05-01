@extends('jellies::message.messageBase')

@section('main')
    <h1>
        {{ trans('jellies::message.index.title') }}
    </h1>
    @if(count($models))
        <div class="panel panel-default">
            <div class="list-group">
                @foreach ($models as $model)
                    <a href="{{ route('message.show', $model->id) }}" class="list-group-item">{{ $model->subject }}</a>
                @endforeach
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            <span class="fa fa-warning"></span>
            {{ trans('jellies::message.index.empty') }}
        </div>
    @endif

@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::message.index.help') }}
    </div>
@endsection
