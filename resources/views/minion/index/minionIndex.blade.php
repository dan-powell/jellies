@extends('jellies::layout.slim.layoutSlim')

@section('main')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ trans_choice('jellies::minion.title', count($models)) }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            @include('jellies::minion.list.minionList', ['minions' => $models])
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    {!! Form::open(['route' => 'minion.store']) !!}
        <button type="submit" class="btn btn-primary">
            {{ trans('jellies::minion.actions.create') }} ({{ config('jellies.minion.cost') }} {{ trans_choice('jellies::game.point', config('jellies.minion.cost')) }})
        </button>
    {!! Form::close() !!}

    <a href="{{ route('minion.deleted') }}">View Dead Minions</a>
@endsection
