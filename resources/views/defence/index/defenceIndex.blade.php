@extends('jellies::defence.defenceBase')

@section('main')
    <h1>{{ trans('jellies::defence.index.title') }}</h1>

    <div class="panel panel-default">
        @if(isset($models) && count($models))
            @include('jellies::defence.list.defenceList', ['models' => $models])
        @else
            <div class="panel-body">
                <p>{{ trans('jellies::defence.index.empty') }}</p>
            </div>
        @endif
    </div>
@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::defence.index.help') }}
    </div>
@endsection
