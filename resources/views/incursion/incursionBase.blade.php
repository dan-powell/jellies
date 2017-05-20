@extends('jellies::base')

@section('sidebar')
    <h2>{{ trans('jellies::incursion.title') }}</h2>
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="">
            <a href="{{ route('incursion.index') }}">{{ trans('jellies::incursion.index.action') }}</a>
        </li>
        <li role="presentation" class="">
            <a href="{{ route('incursion.create') }}" class="">{{ trans('jellies::incursion.create.action') }}</a>
        </li>
    </ul>
@endsection
