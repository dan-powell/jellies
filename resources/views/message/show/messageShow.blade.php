@extends('jellies::message.messageBase')

@section('main')
    <h1>{{ $model->subject }}</h1>
    <div class="panel panel-default">
        <div class="panel-body">
            {{ $model->message }}
        </div>
    </div>
@endsection
