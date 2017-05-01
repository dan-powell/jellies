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
            <span class="fa fa-warning"></span> {{ trans('jellies::minion.index.empty') }}
        </div>
    @endif

@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::incursion.create.help') }}
    </div>
    <div class="alert alert-danger">
        <span class="fa fa-exclamation-circle"></span> {{ trans('jellies::incursion.create.danger') }}
    </div>
@endsection
