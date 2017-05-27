@extends('jellies::base')

@section('main')

    <h1>
        {{ trans('jellies::incursion.show.title') }}
        <small>{{ $model->created_at->format(config('jellies.ui.date_time_format')) }}</small>
    </h1>

    @if($model->active)
        <div class="alert alert-info">
            <h4>{{ trans('jellies::incursion.show.messages.active') }}</h4>
        </div>
    @elseif($model->defeated)
        <div class="alert alert-danger">
            <h4>{{ trans('jellies::incursion.show.messages.defeated') }}</h4>
        </div>
    @elseif($model->waiting && !$model->completed)
        <div class="alert alert-success">
            <h4>{{ trans('jellies::incursion.show.messages.waiting') }}</h4>
        </div>
    @else
        <div class="alert alert-info">
            <h4>{{ trans('jellies::incursion.show.messages.inactive') }}</h4>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-4">
            <div class="alert alert-success">
                <h3>{{ trans('jellies::incursion.show.boxes.zone.title') }}</h3>
                @if($model->zone)
                    <p>{{ trans('jellies::incursion.show.boxes.zone.current') }}: <strong>{{ $model->zone->name }}</strong></p>
                    <p>{{ trans('jellies::incursion.show.boxes.zone.encounters') }}: <strong>{{ count($model->zone->encounters->where('incursion_id', $model->id)) }} / {{ $model->zone->size }}</strong></p>
                @endif
                @if(isset($model->previous_zones) && count($model->previous_zones))
                    <p>{{ trans('jellies::incursion.show.boxes.zone.defeated') }}:
                        <ul>
                            @foreach($model->previous_zones as $zone)
                                <li>{{ $zone->name }}</li>
                            @endforeach
                        </ul>
                    </p>
                @endif
            </div>
        </div>

        <div class="col-sm-4">
            <div class="alert alert-danger">
                <h3>{{ trans('jellies::incursion.show.boxes.minions.title') }}</h3>
                <span class="badge">{{ count($model->minions) }}</span>
                {{ trans_choice('jellies::incursion.show.boxes.minions.remaining', count($model->minions)) }}
                <br/>
                <span class="badge">{{ count($model->rounds) }}</span>
                {{ trans_choice('jellies::incursion.show.boxes.minions.rounds', count($model->rounds)) }}
            </div>
        </div>

        <div class="col-sm-4">
            <div class="alert alert-info">
                <h3>{{ trans('jellies::incursion.show.boxes.points.title') }}</h3>
                <span class="badge">{{ $model->points }}</span>
                {{ trans_choice('jellies::incursion.show.boxes.points.gathered', $model->points) }}
            </div>
        </div>
    </div>

    @if($model->active)
        <a href="{{ route('incursion.process', $model->id) }}" class="btn btn-default pull-right">
            {{ trans('jellies::incursion.show.actions.process') }}
        </a>
    @endif

    <div class="row">

        @if($model->defeated)
            {!! Form::open(['route' => ['incursion.destroy', $model->id ], 'method' => 'delete', 'class' => 'col-sm-3']) !!}
                <button material="submit" class="btn btn-danger">
                    {{ trans('jellies::incursion.show.actions.delete') }}
                </button>
            {!! Form::close() !!}
        @endif

        @if($model->waiting && !$model->complete)
            {!! Form::open(['route' => ['incursion.proceed', $model->id ], 'class' => 'col-sm-3']) !!}
                <button material="submit" class="btn btn-primary">
                    {{ trans('jellies::incursion.show.actions.proceed') }}
                </button>
            {!! Form::close() !!}
        @endif

        @if($model->complete || $model->waiting)
            {!! Form::open(['route' => ['incursion.finish', $model->id ], 'method' => 'delete', 'class' => 'col-sm-3']) !!}
                <button material="submit" class="btn btn-info">
                    {{ trans('jellies::incursion.show.actions.finish') }}
                </button>
            {!! Form::close() !!}
        @endif

    </div>

    <hr class="clear"/>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('jellies::incursion.show.log') }}</h3>
        </div>

        <div class="list-group">
            @forelse($model->encounters->sortByDesc('created_at') as $encounter)
                <a href="{{ route('encounter.show', $encounter->id) }}" class="list-group-item">
                    <i class="fa fa-clock-o"></i>
                    {{ $encounter->created_at->format(config('jellies.ui.time_format')) }}

                    @if($encounter->victory)
                        <i class="fa fa-check fa-lg text-primary"></i>
                    @else
                        <i class="fa fa-times fa-lg text-danger"></i>
                    @endif
                </a>
            @empty
                <div class="alert alert-warning">
                    <span class="fa fa-warning"></span>
                    {{ trans('jellies::incursion.show.empty') }}
                </div>
            @endforelse
        </div>

    </div>

@endsection
