@extends('jellies::base')

@section('sidebar')
    <h3>Navigation</h3>
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="">
            <a href="{{ route('enemy.index') }}">{{ trans('jellies::enemy.index.action') }}</a>
        </li>
    </ul>

    <h3>Actions</h3>

@endsection
