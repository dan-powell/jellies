@extends('jellies::base')

@section('sidebar')
    <h2>{{ trans('jellies::enemy.title') }}</h2>
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="">
            <a href="{{ route('enemy.index') }}">{{ trans('jellies::enemy.index.action') }}</a>
        </li>
    </ul>
@endsection
