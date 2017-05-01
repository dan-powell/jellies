@extends('jellies::minion.minionBase')

@section('main')

    <h1>
        {{ trans('jellies::minion.create.title') }}
    </h1>

    {!! Form::open(['route' => 'minion.store']) !!}

        <div class="panel panel-default">

            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">
                    {{ trans('jellies::minion.create.action') }}
                </button>
            </div>

        </div>

    {!! Form::close() !!}

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
