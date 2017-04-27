@extends('jellies::layout.slim.layoutSlim')

@section('main')
                <h2>{{ $model->subject }}</h2>

                <div class="panel panel-default">
                    <div class="panel-body">
                        {{ $model->message }}
                    </div>
                </div>
@endsection
