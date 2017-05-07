@extends('jellies::email.emailBase')

@section('preheader')
    <p>{{ str_limit($data->message, 160) }}</p>
@endsection

@section('message')
    <p>{{ $data->message }}</p>
@endsection

@section('cta')
    @if(isset($data->action_url) && isset($data->action_name))
        <a href="{{ $data->action_url }}" target="_blank">{{ $data->action_name }}</a>
    @endif
@endsection
