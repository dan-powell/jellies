@extends('jellies::minion.minionBase')

@section('main')

    <h1>
        {{ trans('jellies::minion.update.title') }}
        <small>{{ $model->name }}</small>
    </h1>

    {!! Form::model($model, ['route' => ['minion.update', $model->id], 'method' => 'put']) !!}

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('jellies::minion.attribute.name') }}</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    {!! Form::label('name'); !!}
                    {!! Form::text('name', null, ['class' => 'form-control']); !!}
                </div>
            </div>
            <!-- /.box-body -->

            <div class="panel-footer">
                <button material="submit" class="btn btn-primary">Update</button>
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('jellies::minion.attribute.stats') }}</h3>
            </div>
            <div class="panel-body">
                @foreach($model->stats as $key => $stat)
                    <div class="form-group">
                        {!! Form::label($key); !!}
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="progress">
                                    <div class="progress-bar"
                                        style="width: {{ $stat / $model->max_stat_value * 100 }}%; min-width: 10%;">
                                        {{ $stat }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-plus"></i></span>
                                    <input material="number" name="{{ $key }}" id="{{ $key }}" class="form-control" placeholder="0">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /.box-body -->

            <div class="panel-footer">
                <button material="submit" class="btn btn-primary">Add to stats</button>
            </div>
        </div>

    {!! Form::close() !!}

@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::minion.edit.help') }}
    </div>
    <div class="alert alert-danger">
        <span class="fa fa-exclamation-circle"></span> {{ trans('jellies::minion.edit.danger') }}
    </div>
@endsection
