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
    @else
        <div class="alert alert-success">
            <h4>{{ trans('jellies::incursion.show.inactive') }}</h4>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-4">
            <div class="alert alert-success">
                <span class="badge">{{ count($model->minions) }}</span>
                {{ trans_choice('jellies::minion.plural', count($model->minions)) }} {{ trans('jellies::incursion.remaining') }}
            </div>
        </div>

        <div class="col-sm-4">
            <div class="alert alert-danger">
                <span class="badge">{{ count($model->encounters) }}</span>
                {{ trans_choice('jellies::encounter.plural', count($model->encounters)) }}
                <br/>
                <span class="badge">{{ count($model->rounds) }}</span>
                {{ trans_choice('jellies::encounter.rounds.plural', count($model->rounds)) }}
            </div>
        </div>

        <div class="col-sm-4">
            <div class="alert alert-info">
                <span class="badge">{{ count($model->points) }}</span>
                {{ trans_choice('jellies::game.point.plural', count($model->points)) }} {{ trans('jellies::incursion.gathered') }}
            </div>
        </div>
    </div>

    @if($model->active)
        <a href="{{ route('test.processIncursion', $model->id) }}" class="btn btn-danger">
            Process Incursion
        </a>
    @else
        {!! Form::open(['route' => ['incursion.destroy', $model->id ], 'method' => 'delete']) !!}
            <button type="submit" class="btn btn-danger">
                {{ trans('jellies::incursion.delete.action') }}
            </button>
        {!! Form::close() !!}
    @endif

    <h3>{{ trans('jellies::incursion.show.log') }}</h3>

    @forelse($model->encounters->sortByDesc('created_at') as $encounter)

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="fa fa-clock-o"></i>
                    {{ $encounter->created_at->format(config('jellies.ui.time_format')) }}

                    @if($encounter->victory)
                        <i class="fa fa-check fa-lg text-primary"></i>
                    @else
                        <i class="fa fa-times fa-lg text-danger"></i>
                    @endif
                </div>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th>{{ trans('jellies::encounter.attribute.minions') }}</th>
                    <th>{{ trans('jellies::encounter.attribute.enemies') }}</th>
                    <th>{{ trans('jellies::encounter.attribute.victory') }}</th>
                    <th>{{ trans('jellies::encounter.attribute.rounds') }}</th>
                    <th>{{ trans('jellies::encounter.attribute.damage_minion') }}</th>
                    <th>{{ trans('jellies::encounter.attribute.damage_enemy') }}</th>
                    <th>{{ trans('jellies::encounter.attribute.points') }}</th>
                </tr>
                <tr>
                    <td>
                        {{ count($encounter->minions) }}
                    </td>
                    <td>
                        {{ count($encounter->enemies) }}
                    </td>
                    <td>
                        @if($encounter->victory)
                            <span class="fa fa-check"></span>
                        @endif
                    </td>
                    <td>
                        {{ $encounter->rounds }}
                    </td>
                    <td>
                        {{ $encounter->minion_damage }}
                    </td>
                    <td>
                        {{ $encounter->enemy_damage }}
                    </td>
                    <td>
                        {{ $encounter->points }}
                    </td>
                </tr>
            </table>
            <div class="panel-body">
                <div class="panel-group" id="#encounter_{{ $encounter->id }}">

                    @if(isset($encounter->minions) && count($encounter->minions))
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#minions_{{ $encounter->id }}" data-toggle="collapse" data-target="#minions_{{ $encounter->id }}" data-parent="#encounter_{{ $encounter->id }}">
                                        {{ trans('jellies::encounter.attribute.minions') }} <span class="fa fa-plus pull-right"></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="minions_{{ $encounter->id }}" class="collapse">
                                @include('jellies::minion.list.minionList', ['minions' => $encounter->minions])
                            </div>
                        </div>
                    @endif

                    @if(isset($encounter->enemies) && count($encounter->enemies))
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#enemies_{{ $encounter->id }}" data-toggle="collapse" data-target="#enemies_{{ $encounter->id }}" data-parent="#encounter_{{ $encounter->id }}">
                                        {{ trans('jellies::encounter.attribute.enemies') }} <span class="fa fa-plus pull-right"></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="enemies_{{ $encounter->id }}" class="collapse">
                                @include('jellies::enemy.list.enemyList', ['enemies' => $encounter->enemies])
                            </div>
                        </div>
                    @endif

                    @if(isset($encounter->log) && count($encounter->log))
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a href="#log_{{ $encounter->id }}" data-toggle="collapse" data-target="#log_{{ $encounter->id }}" data-parent="#encounter_{{ $encounter->id }}">
                                        {{ trans('jellies::encounter.attribute.log') }} <span class="fa fa-plus pull-right"></span>
                                    </a>
                                </h3>
                            </div>
                            <div id="log_{{ $encounter->id }}" class="collapse">
                                 <ul class="list-group">
                                   @foreach($encounter->log as $item)
                                       <li class="list-group-item">{{ $item }}</li>
                                   @endforeach
                                 </ul>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    @empty
        <div class="alert alert-warning">
            <span class="fa fa-warning"></span> 
            {{ trans('jellies::incursion.show.empty') }}
        </div>
    @endforelse

@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::incursion.show.help') }}
    </div>
@endsection
