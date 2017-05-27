@extends('jellies::incursion.incursionBase')

@section('main')

    <h1>
        {{ trans('jellies::incursion.create.title') }}
    </h1>

    @if(count($minions))

        {!! Form::open(['route' => 'incursion.store']) !!}

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">
                        <strong>{{ trans_choice('jellies::incursion.create.setup', count($minions)) }}</strong>
                    </h3>
                </div>

                <div class="panel-body">
                    {!! Form::label('minions', trans_choice('jellies::incursion.create.minions', count($minions))) !!}
                    <select multiple="multiple" id="minions" name="minions[]" class="form-control">
                        @foreach($minions as $minion)
                            <option value="{{ $minion->id }}">{{ $minion->name }} - lvl {{ $minion->level }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="panel-body">
                    {!! Form::label('realm', trans_choice('jellies::incursion.create.realm', count($minions))) !!}
                    <select id="realm" name="realm" class="form-control">
                        @foreach($realms as $realm)
                            <option value="{{ $realm->id }}">{{ $realm->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="panel-footer">
                    <button material="submit" class="btn btn-primary">
                        {{ trans('jellies::incursion.create.action') }}
                    </button>
                </div>

            </div>

        {!! Form::close() !!}

    @else
        <div class="alert alert-warning">
            <span class="fa fa-warning"></span> {{ trans('jellies::minion.index.empty') }}
        </div>
    @endif

@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::incursion.create.help') }}
    </div>
@endsection
