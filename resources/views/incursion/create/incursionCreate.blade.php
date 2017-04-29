@extends('jellies::base')

@section('main')

    <h1>
        {{ trans('jellies::incursion.create.title') }}
    </h1>

    @if(count($minions))

        {!! Form::open(['route' => 'incursion.store']) !!}

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">
                        <strong>{{ trans_choice('jellies::incursion.create.choose', count($minions)) }}</strong>
                    </h3>
                </div>

                <div class="panel-body">
                    <select multiple="multiple" id="minions" name="minions[]" class="form-control">
                        @foreach($minions as $minion)
                            <option value="{{ $minion->id }}">{{ $minion->name }} - lvl {{ $minion->level }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">
                        {{ trans('jellies::incursion.create.action') }}
                    </button>
                </div>

            </div>

        {!! Form::close() !!}

    @else
        <div class="alert alert-warning">
            {{ trans('jellies::minion.index.empty') }}
        </div>
    @endif

@endsection
