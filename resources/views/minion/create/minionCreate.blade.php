@extends('jellies::minion.minionBase')

@section('main')

    <h1>
        {{ trans('jellies::minion.create.title') }}
    </h1>

    {!! Form::open(['route' => 'minion.store']) !!}

        <div class="panel panel-default">

            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">
                    {{ trans('jellies::incursion.create.action') }}
                </button>
            </div>

        </div>

    {!! Form::close() !!}

@endsection
