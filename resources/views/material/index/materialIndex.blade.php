@extends('jellies::material.materialBase')

@section('main')
    <h1>{{ trans('jellies::material.index.title') }}</h1>

    <div class="panel panel-default">
        @if(isset($models) && count($models))
            @include('jellies::material.list.materialList', ['models' => $models])
        @else
            <div class="panel-body">
                <p>{{ trans('jellies::material.index.empty') }}</p>
            </div>
        @endif
    </div>
@endsection

@section('help')
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::material.index.help') }}
    </div>
@endsection
