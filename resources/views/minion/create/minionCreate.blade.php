@extends('jellies::minion.minionBase')

@section('main')

    <h1>
        {{ trans('jellies::minion.create.title') }}
    </h1>

    @foreach($models as $model)
        {!! Form::open(['route' => 'minion.store']) !!}
            <div class="panel panel-default">
                <div class="panel-heading"><strong>{{ $model->name }}</strong></div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($model->stats as $key => $stat)
                            <div class="col-xs-4 text-right">
                                {{ trans('jellies::minion.attribute.' . $key) }}
                                <span class="{{ config('jellies.ui.stat_icons.' . $key) }}"></span>
                            </div>
                            <div class="col-xs-8">
                                <div class="progress">
                                    <div class="progress-bar"
                                    role="progressbar"
                                    aria-valuenow="{{ $stat }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                    style="width: {{ $stat / $model->max_stat_value * 100 }}%; min-width: 10%;">
                                        {{ $stat }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="panel-footer">
                    <input type="hidden" name="id" value="{{ $model->id }}"/>
                    <button type="submit" class="btn btn-primary"/>
                        {{ trans('jellies::minion.create.action') }} ({{ $model->cost }} {{ trans_choice('jellies::game.point.plural', $model->cost) }})
                    </button>
                </div>
            </div>
        {!! Form::close() !!}
    @endforeach


@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::minion.create.help') }}
    </div>
    <div class="alert alert-danger">
        <span class="fa fa-exclamation-circle"></span> {{ trans('jellies::minion.create.danger') }}
    </div>
@endsection
