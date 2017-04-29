@extends('jellies::base')

@section('main')

            <div class="panel panel-default">
                <div class="panel-heading">Messages</div>

                <div class="panel-body">

                    @forelse ($models as $model)
                        <p><a href="{{ route('message.show', $model->id) }}">{{ $model->subject }}</a></p>
                    @empty
                        <p>No messages</p>
                    @endforelse

                </div>
            </div>

@endsection
