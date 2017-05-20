@extends('jellies::base')

@section('main')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="fa fa-clock-o"></i>
                Encounter Summary – {{ $model->created_at->format(config('jellies.ui.time_format')) }}

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
    </div>


    @if(isset($model->minions_before) && count($model->minions_before))
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4 class="panel-title">
                    {{ trans('jellies::encounter.attribute.minions') }} Before
                </h4>
            </div>

            @include('jellies::minion.list.minionList', ['minions' => $model->minions_before])

        </div>
    @endif

    @if(isset($model->minions_after) && count($model->minions_after))
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4 class="panel-title">
                    {{ trans('jellies::encounter.attribute.minions') }} After
                </h4>
            </div>
            @include('jellies::minion.list.minionList', ['minions' => $model->minions_after])
        </div>
    @endif

    @if(isset($model->enemies) && count($model->enemies))
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h4 class="panel-title">
                    {{ trans('jellies::encounter.attribute.enemies') }}
                </h4>
            </div>
            @include('jellies::enemy.list.enemyList', ['enemies' => $model->enemies])
        </div>
    @endif

    @if(isset($model->log) && count($model->log))
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    {{ trans('jellies::encounter.attribute.log') }}
                </h3>
            </div>
             <ul class="list-group">
               @foreach($model->log as $item)
                   <li class="list-group-item">{{ $item }}</li>
               @endforeach
             </ul>
        </div>
    @endif

@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::incursion.show.help') }}
    </div>
@endsection
