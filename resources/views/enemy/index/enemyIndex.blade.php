@extends('jellies::layout.slim.layoutSlim')

@section('main')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ trans_choice('jellies::enemy.title', count($models)) }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            @include('jellies::enemy.list.enemyList', ['enemies' => $models])
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection
