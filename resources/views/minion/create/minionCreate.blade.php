@extends('jellies::minion.minionBase')

@section('main')

    <h1>
        {{ trans('jellies::minion.create.title') }}
    </h1>

    {!! Form::open(['route' => 'minion.store', 'class' => 'form-vertical']) !!}

        <div class="panel panel-default">
            <div class="panel-heading"><strong>{{ trans('jellies::minion.create.types') }}</strong></div>

            @if(isset($types) && count($types))
                <div class="panel-body">
                    <div class="row">
                        @foreach ($types as $model)
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="type[{{ $model->id }}]">{{ $model->name }}</label>
                                    <div class="btn-group btn-group-xs pull-right">
                                        @if(count($model->effective))
                                        <a class="btn btn-success" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="{{ trans('jellies::type.attribute.effective') }}" data-content=" {{ $model->effective->implode('name', ', ') }}
                                            ">
                                            {{ count($model->effective) }}
                                        </a>
                                        @endif
                                        @if(count($model->ineffective))
                                            <a class="btn btn-danger" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="{{ trans('jellies::type.attribute.ineffective') }}" data-content="{{ $model->ineffective->implode('name', ', ') }}
                                                ">
                                                {{ count($model->ineffective) }}
                                            </a>
                                        @endif
                                        @foreach($model->modifiers as $modifier)
                                            <a class="btn btn-primary" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="{{ trans('jellies::type.attribute.modofiers') }}" data-content="
                                                {{ $modifier->attribute }} {{ $modifier->adjustment }} {{ $modifier->value }}
                                                ">
                                                {{ $modifier->adjustment }}
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="type[{{ $model->id }}]" name="type[{{ $model->id }}]"/>
                                        <span class="input-group-addon">
                                            <span class="badge">{{ $model->pivot->quantity }}</span>
                                            {{ trans('jellies::minion.create.available') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

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
@endsection
