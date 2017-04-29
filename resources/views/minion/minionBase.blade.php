@extends('jellies::base')

@section('sidebar')
    <h3>Navigation</h3>
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="">
            <a href="{{ route('minion.index') }}">{{ trans('jellies::minion.index.action') }}</a>
        </li>

        <li role="presentation" class="">
            <a href="{{ route('minion.deleted') }}">{{ trans('jellies::minion.indexdeleted.action') }}</a>
        </li>
    </ul>

    <h3>Actions</h3>
    {!! Form::open(['route' => 'minion.store']) !!}
        <button type="submit" class="btn btn-primary btn-block">
            {{ trans('jellies::minion.create.title') }}
        </button>
    {!! Form::close() !!}
@endsection
