@extends('jellies::minion.minionBase')

@section('main')

    <h1>
        <span class="fa fa-paw"></span> {{ $model->name }}
        <small>
            {{ trans('jellies::minion.attribute.level') }} {{ $model->level }}
        </small>
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::minion.attribute.stats') }}</strong></div>
        <div class="panel-body">

            <div class="row">
                @foreach($model->stats as $key => $stat)
                    <div class="col-xs-3 text-right">
                        {{ trans('jellies::minion.attribute.' . $key) }}
                    </div>
                    <div class="col-xs-9">
                        <div class="progress">
                            <div class="progress-bar"
                            role="progressbar"
                            aria-valuenow="{{ $stat }}"
                            aria-valuemin="0"
                            aria-valuemax="100"
                            style="width: {{ $stat / $model->max_stat_value * 100 }}%; min-width: 10%;">
                                {{ $stat }}
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-xs-3 text-right">
                    {{ trans('jellies::minion.attribute.hp') }}
                </div>
                <div class="col-xs-9">
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger"
                        style="width: {{ $model->health / $model->max_stat_value * 100 }}%; min-width: 10%;">
                            {{ $model->health }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::type.attribute.effective') }}</strong></div>

        <div class="list-group">
            @foreach($model->effective as $key => $effective)
                <a href="{{ route('type.show', $key) }}" class="list-group-item">{{ $effective }}</a>
            @endforeach
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::type.attribute.ineffective') }}</strong></div>

        <div class="list-group">
            @foreach($model->ineffective as $key => $ineffective)
                <a href="{{ route('type.show', $key) }}" class="list-group-item">{{ $ineffective }}</a>
            @endforeach
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::minion.attribute.types') }}</strong></div>
        @if(isset($model->types) && count($model->types))
            <table class="table table-striped table-hover">
                <tr>
                    <th></th>
                    <th>{{ trans('jellies::type.attribute.name') }}</th>
                    <th>{{ trans('jellies::type.attribute.quantity') }}</th>
                </tr>
                @foreach ($model->types as $type)
                    <tr onclick="window.open('{{ route('type.show', $type->id) }}', '_self')">
                        <td>
                            <span class="fa fa-tint"></span>
                        </td>
                        <td>
                            <a href="{{ route('type.show', $type->id) }}">
                                {{ $type->name }}
                            </a>
                        </td>
                        <td>
                            {{ $type->pivot->quantity }}
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>

@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::minion.show.help') }}
    </div>
@endsection
