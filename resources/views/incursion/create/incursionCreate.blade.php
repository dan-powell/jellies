@extends('jellies::layout.slim.layoutSlim')

@section('main')

    <h2>
        {{ trans('jellies::incursion.actions.create') }}
    </h2>

    @if(count($minions))

        {!! Form::open(['route' => 'incursion.store']) !!}

            <div class="panel panel-default">
                <div class="panel-heading"><strong>Choose your {{ trans_choice('jellies::minion.sentence', count($minions)) }}</strong></div>

                <select multiple="multiple" id="minions" name="minions[]" class="form-control">
                    @foreach($minions as $minion)
                        <option value="{{ $minion->id }}">{{ $minion->firstname }}</option>
                    @endforeach
                </select>

            </div>

            <button type="submit" class="btn btn-primary">
                {{ trans('jellies::incursion.actions.store') }} ({{ config('jellies.incursion.cost') }} {{ trans_choice('jellies::game.point', config('jellies.incursion.cost')) }})
            </button>

        {!! Form::close() !!}

    @else

        <div class="alert alert-warning">
            {{ trans('jellies::incursion.errors.no_minions') }}
        </div>

    @endif

@endsection
