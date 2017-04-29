@extends('jellies::base')

@section('sidebar')
    <h3>Navigation</h3>
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="">
            <a href="{{ route('incursion.index') }}">{{ trans('jellies::incursion.index.action') }}</a>
        </li>
    </ul>

    <h3>Actions</h3>

    <a href="{{ route('incursion.create') }}" class="btn btn-primary btn-block">
        {{ trans('jellies::incursion.create.action') }}
    </a>
@endsection
