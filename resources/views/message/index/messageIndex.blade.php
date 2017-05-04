@extends('jellies::message.messageBase')

@section('main')
    <h1>
        {{ trans('jellies::message.index.title') }}
    </h1>
    @if(count($models))
        <div class="panel panel-default">
            <div class="list-group">
                @foreach ($models as $model)
                    <a href="{{ route('message.show', $model->id) }}" class="list-group-item list-group-item-{{ $model->type }}">
                        <small class="pull-right">
                            <i class="fa fa-calendar"></i> {{ $model->created_at->format(config('jellies.ui.date_format')) }}
                            <i class="fa fa-clock-o"></i> {{ $model->created_at->format(config('jellies.ui.time_format')) }}
                        </small>

                        @if(!$model->read)
                            <h4><span class="fa fa-envelope"></span> <strong>{{ $model->subject }}</strong></h4>
                        @else
                            <h4><span class="fa fa-envelope-open"></span> {{ $model->subject }}</h4>
                        @endif
                        
                    </a>
                @endforeach
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            <span class="fa fa-warning"></span>
            {{ trans('jellies::message.index.empty') }}
        </div>
    @endif

@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::message.index.help') }}
    </div>
@endsection
