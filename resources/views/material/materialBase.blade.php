@extends('jellies::base')

@section('sidebar')
    <h2>{{ trans('jellies::material.title') }}</h2>
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="">
            <a href="{{ route('material.index') }}">{{ trans('jellies::material.index.action') }}</a>
        </li>
    </ul>
@endsection
