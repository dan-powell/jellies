@extends('jellies::base')

@section('sidebar')
    <h2>{{ trans('jellies::minion.title') }}</h2>
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="">
            <a href="{{ route('minion.index') }}">{{ trans('jellies::minion.index.action') }}</a>
        </li>

        <li role="presentation" class="">
            <a href="{{ route('minion.deleted') }}">{{ trans('jellies::minion.indexdeleted.action') }}</a>
        </li>

        <li role="presentation" class="">
            <a href="{{ route('minion.create') }}">{{ trans('jellies::minion.create.action') }}</a>
        </li>
    </ul>
@endsection
