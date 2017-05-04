@extends('jellies::base')

@section('main')

    <h1>
        {{ trans('jellies::incursion.show.title') }}
        <small>{{ $model->created_at->format(config('jellies.ui.date_time_format')) }}</small>
    </h1>

    @if($model->active)
        <div class="alert alert-info">
            <h4>{{ trans('jellies::incursion.show.active') }}</h4>
        </div>
    @elseif($model->defeated)
        <div class="alert alert-danger">
            <h4>{{ trans('jellies::incursion.show.defeated') }}</h4>
        </div>
    @elseif($model->waiting && !$model->completed)
        <div class="alert alert-success">
            <h4>{{ trans('jellies::incursion.show.complete') }}</h4>
        </div>
    @else
        <div class="alert alert-info">
            <h4>{{ trans('jellies::incursion.show.inactive') }}</h4>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-4">
            <div class="alert alert-success">
                @if($model->zone)
                    <p>Current Zone: <strong>{{ $model->zone->name or 'None' }}</strong></p>
                    <p>Encounters: <strong>{{ count($model->zone->encounters) }} / {{ $model->zone->size }}</strong></p>
                @endif
                <p>Defeated Zones:
                    <ul>
                        @foreach($model->previous_zones as $zone)
                            <li>{{ $zone->name }}</li>
                        @endforeach
                    </ul>
                </p>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="alert alert-danger">
                <span class="badge">{{ count($model->minions) }}</span>
                {{ trans_choice('jellies::minion.plural', count($model->minions)) }} {{ trans('jellies::incursion.remaining') }}
                <br/>
                <span class="badge">{{ count($model->rounds) }}</span>
                {{ trans_choice('jellies::encounter.rounds.plural', count($model->rounds)) }}
            </div>
        </div>

        <div class="col-sm-4">
            <div class="alert alert-info">
                <span class="badge">{{ $model->points }}</span>
                {{ trans_choice('jellies::game.point.plural', $model->points) }} {{ trans('jellies::incursion.gathered') }}
            </div>
        </div>
    </div>

    @if($model->active)
        <a href="{{ route('incursion.process', $model->id) }}" class="btn btn-danger">
            Process Incursion
        </a>
    @endif

    @if($model->defeated)
        {!! Form::open(['route' => ['incursion.destroy', $model->id ], 'method' => 'delete']) !!}
            <button type="submit" class="btn btn-info">
                {{ trans('jellies::incursion.delete.action') }}
            </button>
        {!! Form::close() !!}
    @endif

    @if($model->waiting && !$model->complete)
        {!! Form::open(['route' => ['incursion.proceed', $model->id ]]) !!}
            <button type="submit" class="btn btn-danger">
                {{ trans('jellies::incursion.proceed.action') }}
            </button>
        {!! Form::close() !!}
    @endif

    @if($model->complete || $model->waiting)
        {!! Form::open(['route' => ['incursion.finish', $model->id ], 'method' => 'delete']) !!}
            <button type="submit" class="btn btn-info">
                {{ trans('jellies::incursion.finish.action') }}
            </button>
        {!! Form::close() !!}
    @endif



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

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::incursion.show.help') }}
    </div>
@endsection
