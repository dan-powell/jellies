@extends('jellies::incursion.incursionBase')

@section('main')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('jellies::incursion.labels.active') }}</h3>
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

    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('jellies::incursion.labels.waiting') }}</h3>
        </div>
        @if(isset($incursions_waiting) && count($incursions_waiting))
            @include('jellies::incursion.list.incursionList', ['incursions' => $incursions_waiting])
        @else
            <div class="panel-body">
                <p>{{ trans('jellies::incursion.index.empty') }}</p>
            </div>
        @endif
    </div>

    <hr>

    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('jellies::incursion.labels.defeated') }}</h3>
        </div>
        @if(isset($incursions_inactive) && count($incursions_inactive))
            @include('jellies::incursion.list.incursionList', ['incursions' => $incursions_inactive])
        @else
            <div class="panel-body">
                <p>{{ trans('jellies::incursion.index.empty') }}</p>
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
