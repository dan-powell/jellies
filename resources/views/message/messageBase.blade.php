@extends('jellies::base')

@section('sidebar')
    <h3>Navigation</h3>
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="">
            <a href="{{ route('message.index') }}">{{ trans('jellies::message.index.action') }}</a>
        </li>
    </ul>
@endsection
