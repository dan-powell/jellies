@extends('jellies::minion.minionBase')

@section('main')

    <h1>
        <span class="game-icon game-icon-slime"></span> {{ $model->name }}
        <small>
            {{ trans('jellies::minion.attribute.level') }} {{ $model->level }}
        </small>
    </h1>



    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::user.attribute.types') }}</strong></div>
        <div class="panel-body">
            <div>
                Attack: {{ $model->getStat('attack') }}
            </div>
            <div>
                Defence: {{ $model->getStat('defence') }}
            </div>
            <div>
                Initiative: {{ $model->getStat('initiative]') }}
            </div>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::user.attribute.types') }}</strong></div>
        <div class="panel-body">
            @if(isset($model->types) && count($model->types))
                <table class="table table-striped table-hover">
                    <tr>
                        <th></th>
                        <th>{{ trans('jellies::type.attribute.name') }}</th>
                        <th>{{ trans('jellies::type.attribute.effective') }}</th>
                    </tr>

                    @foreach ($model->types as $model)
                        <tr onclick="window.open('{{ route('type.show', $model->id) }}', '_self')">
                            <td>
                                <span class="game-icon game-icon-vile-fluid"></span>
                            </td>
                            <td>
                                <a href="{{ route('type.show', $model->id) }}">
                                    {{ $model->name }}
                                </a>
                            </td>
                            <td>
                                {{ $model->pivot->quantity }}
                            </td>
                        </tr>
                    @endforeach
                </table>

            @endif

        </div>
    </div>

@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::minion.show.help') }}
    </div>
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::minion.show.help') }}
    </div>
@endsection
