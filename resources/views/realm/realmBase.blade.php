@extends('jellies::base')

@section('sidebar')
    <h2>{{ trans('jellies::realm.title') }}</h2>
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="">
            <a href="{{ route('realm.index') }}">{{ trans('jellies::realm.index.action') }}</a>
        </li>
    </ul>
@endsection
