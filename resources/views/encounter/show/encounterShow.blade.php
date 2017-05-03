@extends('jellies::base')

@section('main')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="fa fa-clock-o"></i>
                {{ $model->created_at->format(config('jellies.ui.time_format')) }}

                @if($model->victory)
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
                    {{ count($model->minions) }}
                </td>
                <td>
                    {{ count($model->enemies) }}
                </td>
                <td>
                    @if($model->victory)
                        <span class="fa fa-check"></span>
                    @endif
                </td>
                <td>
                    {{ $model->rounds }}
                </td>
                <td>
                    {{ $model->minion_damage }}
                </td>
                <td>
                    {{ $model->enemy_damage }}
                </td>
                <td>
                    {{ $model->points }}
                </td>
            </tr>
        </table>
        <div class="panel-body">
            <div class="panel-group" id="#encounter_{{ $model->id }}">

                @if(isset($model->minions_before) && count($model->minions_before))
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#minionsb_{{ $model->id }}" data-toggle="collapse" data-target="#minionsb_{{ $model->id }}" data-parent="#encounter_{{ $model->id }}">
                                    {{ trans('jellies::encounter.attribute.minions') }} <span class="fa fa-plus pull-right"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="minionsb_{{ $model->id }}" class="collapse">
                            @include('jellies::minion.list.minionList', ['minions' => $model->minions_before])
                        </div>
                    </div>
                @endif

                @if(isset($model->minions_after) && count($model->minions_after))
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#minionsa_{{ $model->id }}" data-toggle="collapse" data-target="#minionsa_{{ $model->id }}" data-parent="#encounter_{{ $model->id }}">
                                    {{ trans('jellies::encounter.attribute.minions') }} <span class="fa fa-plus pull-right"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="minionsa_{{ $model->id }}" class="collapse">
                            @include('jellies::minion.list.minionList', ['minions' => $model->minions_after])
                        </div>
                    </div>
                @endif

                @if(isset($model->enemies) && count($model->enemies))
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#enemies_{{ $model->id }}" data-toggle="collapse" data-target="#enemies_{{ $model->id }}" data-parent="#encounter_{{ $model->id }}">
                                    {{ trans('jellies::encounter.attribute.enemies') }} <span class="fa fa-plus pull-right"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="enemies_{{ $model->id }}" class="collapse">
                            @include('jellies::enemy.list.enemyList', ['enemies' => $model->enemies])
                        </div>
                    </div>
                @endif

                @if(isset($model->log) && count($model->log))
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a href="#log_{{ $model->id }}" data-toggle="collapse" data-target="#log_{{ $model->id }}" data-parent="#encounter_{{ $model->id }}">
                                    {{ trans('jellies::encounter.attribute.log') }} <span class="fa fa-plus pull-right"></span>
                                </a>
                            </h3>
                        </div>
                        <div id="log_{{ $model->id }}" class="collapse">
                             <ul class="list-group">
                               @foreach($model->log as $item)
                                   <li class="list-group-item">{{ $item }}</li>
                               @endforeach
                             </ul>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::incursion.show.help') }}
    </div>
@endsection
