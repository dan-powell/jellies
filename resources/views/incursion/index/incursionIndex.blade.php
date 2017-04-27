@extends('jellies::layout.slim.layoutSlim')

@section('main')

    @if(count($incursions_active))
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">{{ trans('jellies::incursion.title_active') }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                @include('jellies::incursion.list.incursionList', ['incursions' => $incursions_active])
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    @endif

    <a href="{{ route('incursion.create') }}" class="btn btn-primary">
        {{ trans('jellies::incursion.actions.create') }} ({{ config('jellies.incursion.cost') }} {{ trans_choice('jellies::game.point', config('jellies.incursion.cost')) }})
    </a>

    <hr/>

    @if(count($incursions_inactive))
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ trans('jellies::incursion.title_inactive') }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                @include('jellies::incursion.list.incursionList', ['incursions' => $incursions_inactive])
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    @endif

@endsection
