@extends('jellies::minion.minionBase')

@section('main')

    <h1>
        {{ trans('jellies::minion.create.title') }}
    </h1>

    @if(isset($types) && count($types))

        {!! Form::open(['route' => 'minion.store']) !!}

            <div class="panel panel-default">
                <div class="panel-heading"><strong>{{ trans('jellies::user.attribute.types') }}</strong></div>
                <div class="panel-body">

                    {{ trans('jellies::type.attribute.name') }}
                    {{ trans('jellies::type.attribute.effective') }}

                    @foreach ($types as $model)
                        <div>
                            {{ $model->name }}
                            ({{ $model->pivot->quantity }})
                            <input type="number" id="type[{{ $model->id }}]" name="type[{{ $model->id }}]"/>
                        </div>
                    @endforeach

                </div>

                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">
                        {{ trans('jellies::incursion.create.action') }}
                    </button>
                </div>

            </div>

        {!! Form::close() !!}

    @endif

@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::minion.create.help') }}
    </div>
@endsection
