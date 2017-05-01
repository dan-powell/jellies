@extends('jellies::message.messageBase')

@section('main')
    <h1>{{ $model->subject }}</h1>
    <div class="panel panel-default">
        <div class="panel-body">
            {{ $model->message }}
        </div>
    </div>
@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::message.show.help') }}
    </div>
@endsection
