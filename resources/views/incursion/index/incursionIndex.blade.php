@extends('jellies::incursion.incursionBase')

@section('main')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('jellies::incursion.index.title') }}</h3>
        </div>
        @if(isset($incursions_active) && count($incursions_active))
            @include('jellies::incursion.list.incursionList', ['incursions' => $incursions_active])
        @else
            <div class="panel-body">
                <p>{{ trans('jellies::incursion.index.empty') }}</p>
            </div>
        @endif
    </div>

    <hr/>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('jellies::incursion.indexdeleted.title') }}</h3>
        </div>
        @if(isset($incursions_inactive) && count($incursions_inactive))
            @include('jellies::incursion.list.incursionList', ['incursions' => $incursions_inactive])
        @else
            <div class="panel-body">
                <p>{{ trans('jellies::incursion.indexdeleted.empty') }}</p>
            </div>
        @endif
    </div>


@endsection


@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::incursion.index.help') }}
    </div>
@endsection
