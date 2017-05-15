@extends('jellies::base')

@section('sidebar')
    <h2>{{ trans('jellies::type.title') }}</h2>
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="">
            <a href="{{ route('type.index') }}">{{ trans('jellies::type.index.action') }}</a>
        </li>
    </ul>
@endsection
