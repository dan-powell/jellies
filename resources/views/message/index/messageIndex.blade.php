@extends('jellies::message.messageBase')

@section('main')
    <h1>
        {{ trans('jellies::message.index.title') }}
    </h1>
    <div class="panel panel-default">
        <div class="list-group">
            @forelse ($models as $model)
                <a href="{{ route('message.show', $model->id) }}" class="list-group-item">{{ $model->subject }}</a>
            @empty
                <p>{{ trans('jellies::message.index.empty') }}</p>
            @endforelse
        </div>
    </div>

@endsection
