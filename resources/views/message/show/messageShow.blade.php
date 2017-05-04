@extends('jellies::message.messageBase')

@section('main')
    <h1>
        @if(!$model->read)
            <span class="fa fa-envelope"></span>
        @else
            <span class="fa fa-envelope-open"></span>
        @endif
        {{ $model->subject }}
    </h1>
    <div class="panel panel-default">
        <div class="panel-body">
            {{ $model->message }}
        </div>
        @if(isset($model->action_name) && isset($model->action_url))
            <div class="panel-footer">
                <a href="{{ $model->action_url }}" class="btn btn-primary">{{ $model->action_name }}</a>
            </div>
        @endif
    </div>
@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::message.show.help') }}
    </div>
@endsection
