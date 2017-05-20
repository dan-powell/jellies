@extends('jellies::base')

@section('sidebar')
    <h2>{{ trans('jellies::user.title') }}</h2>
    <ul class="nav nav-pills nav-stacked">

        <li role="presentation" class="">
            <a href="{{ route('user.index') }}">{{ trans('jellies::user.index.action') }}</a>
        </li>

        <li role="presentation" class="">
            <a href="{{ route('attack.index') }}">{{ trans('jellies::attack.index.action') }}</a>
        </li>

        <li role="presentation" class="">
            <a href="{{ route('defence.index') }}">{{ trans('jellies::defence.index.action') }}</a>
        </li>

        <li role="presentation" class="">
            <a href="{{ route('attack.create') }}">{{ trans('jellies::attack.create.action') }}</a>
        </li>
    </ul>
@endsection
