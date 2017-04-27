@extends('jellies::layout.slim.layoutSlim')

@section('title')
Update Minion: {{ $model->firstname }}
@endsection

@section('main')

    {!! Form::model($model, ['route' => ['minion.update', $model->id], 'method' => 'put']) !!}

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Name</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('firstname'); !!}
                    {!! Form::text('firstname', null, ['class' => 'form-control']); !!}
                </div>
                <div class="form-group">
                    {!! Form::label('nickname'); !!}
                    {!! Form::text('nickname', null, ['class' => 'form-control']); !!}
                </div>
                <div class="form-group">
                    {!! Form::label('lastname'); !!}
                    {!! Form::text('lastname', null, ['class' => 'form-control']); !!}
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>


        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Stats</h3>
            </div>
            <div class="box-body">
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
                                    <input type="number" name="{{ $key }}" id="{{ $key }}" class="form-control" placeholder="0">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add to stats</button>
            </div>
        </div>

    {!! Form::close() !!}

@endsection
