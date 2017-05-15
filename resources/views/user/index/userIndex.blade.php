@extends('jellies::user.userBase')

@section('main')
    <h1>{{ trans('jellies::user.index.title') }}</h1>

    <div class="panel panel-default">
        @if(isset($models) && count($models))
            @include('jellies::user.list.userList', ['users' => $models])
        @else
            <div class="panel-body">
                <p>{{ trans('jellies::user.index.empty') }}</p>
            </div>
        @endif
    </div>
@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::user.index.help') }}
    </div>
@endsection
