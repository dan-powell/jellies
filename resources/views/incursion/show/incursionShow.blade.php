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
                {{ trans_choice('jellies::encounter.rounds', count($model->rounds)) }}
            </div>
        </div>

        <div class="col-sm-4">
            <div class="alert alert-info">
                <span class="badge">{{ count($model->points) }}</span>
                {{ trans_choice('jellies::game.points', count($model->points)) }} {{ trans('jellies::incursion.gathered') }}
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

    @if(count($model->encounters))

        <h3>Encounter Log</h3>

        <ul class="timeline">

            @foreach($model->encounters->sortByDesc('created_at') as $encounter)

                <!-- timeline item -->
                <li>
                    <!-- timeline icon -->

                    @if($encounter->victory)
                        <i class="fa fa-check bg-blue"></i>
                    @else
                        <i class="fa fa-times bg-red"></i>
                    @endif

                    <div class="timeline-item">

                        <h3 class="timeline-header">
                            <i class="fa fa-clock-o"></i>
                            {{ $encounter->created_at->format(config('jellies.ui.time_format')) }}
                        </h3>

                        <div class="timeline-body">

                            <table class="table table-striped table-hover">
                                <tr>
                                    <th>Minions</th>
                                    <th>Enemies</th>
                                    <th>Victorious?</th>
                                    <th>Rounds</th>
                                    <th>Damage Inflicted by Minion</th>
                                    <th>Damage Inflicted by Enemy</th>
                                    <th>Souls gained</th>
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

                            @if(isset($encounter->minions) && count($encounter->minions))
                                <div class="box box-success collapsed-box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">
                                            Minions
                                        </h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="display: none;">
                                        @include('jellies::minion.list.minionList', ['minions' => $encounter->minions])
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            @endif

                            @if(isset($encounter->enemies) && count($encounter->enemies))
                                <div class="box box-danger collapsed-box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">
                                            Enemies
                                        </h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="display: none;">
                                        @include('jellies::enemy.list.enemyList', ['enemies' => $encounter->enemies])
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            @endif

                            @if(isset($encounter->log) && count($encounter->log))

                                <div class="box box-info collapsed-box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">
                                            Battle Log
                                        </h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="display: none;">
                                        <!-- List group -->
                                         <ul class="list-group">
                                           @foreach($encounter->log as $item)
                                               <li class="list-group-item">{{ $item }}</li>
                                           @endforeach
                                         </ul>
                                    </div>
                                    <!-- /.box-body -->
                                </div>

                            @endif

                        </div>

                        {{-- <div class="timeline-footer">

                        </div> --}}

                    </div>
                </li>
                <!-- END timeline item -->
            @endforeach

            <!-- timeline time label -->
            <li class="time-label">
                <span class="bg-red">
                    {{ $model->created_at->format(config('jellies.ui.date_time_format')) }}
                </span>
            </li>
            <!-- /.timeline-label -->


        </ul>

    @endif

@endsection
