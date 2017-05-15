@extends('jellies::type.typeBase')

@section('main')
    <h1>{{ trans('jellies::type.index.title') }}</h1>

    <div class="panel panel-default">
        @if(isset($models) && count($models))
            @include('jellies::type.list.typeList', ['models' => $models])
        @else
            <div class="panel-body">
                <p>{{ trans('jellies::type.index.empty') }}</p>
            </div>
        @endif
    </div>
@endsection

@section('help')
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::type.index.help') }}
    </div>
@endsection
