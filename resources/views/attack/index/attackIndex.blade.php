@extends('jellies::attack.attackBase')

@section('main')
    <h1>{{ trans('jellies::attack.index.title') }}</h1>

    <div class="panel panel-default">
        @if(isset($models) && count($models))
            @include('jellies::attack.list.attackList', ['models' => $models])
        @else
            <div class="panel-body">
                <p>{{ trans('jellies::attack.index.empty') }}</p>
            </div>
        @endif
    </div>
@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::attack.index.help') }}
    </div>
@endsection
