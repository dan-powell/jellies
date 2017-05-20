@extends('jellies::user.userBase')

@section('main')

    <h1>
        {{ trans('jellies::attack.create.title') }}
    </h1>


    {!! Form::open(['route' => 'attack.store']) !!}

        <div class="panel panel-default">
            <div class="panel-heading"><strong>{{ trans('jellies::attack.attribute.types') }}</strong></div>

            <div class="panel-body">
                @if(isset($minions) && count($minions))
                    <select name="minion" class="form-control">
                        @foreach ($minions as $model)
                            <option value="{{ $model->id }}">{{ $model->name }}</option>
                        @endforeach
                    </select>
                @endif
            </div>

            <div class="panel-body">
                @if(isset($users) && count($users))
                    @foreach ($users as $model)
                        <div class="radio">
                            <label>
                                <input type="radio" name="user" value="{{ $model->id }}">{{ $model->name }} {{ count($model->minions) }}</option>
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">
                    {{ trans('jellies::attack.create.action') }}
                </button>
            </div>

        </div>

    {!! Form::close() !!}

@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::attack.create.help') }}
    </div>
@endsection
