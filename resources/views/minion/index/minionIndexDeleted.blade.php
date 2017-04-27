@extends('jellies::layout.slim.layoutSlim')

@section('main')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Dead {{ trans_choice('jellies::minion.title', count($models)) }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            @include('jellies::minion.list.minionList', ['minions' => $models])
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection
