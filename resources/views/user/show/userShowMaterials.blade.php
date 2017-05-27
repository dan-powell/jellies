@extends('jellies::user.userBase')

@section('main')

    <h1>
        <span class="game-icon game-icon-slime"></span> {{ $model->name }}
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>{{ trans('jellies::user.attribute.materials') }}</strong></div>
        <div class="panel-body">
            @if(isset($model->materials) && count($model->materials))
                <table class="table table-striped table-hover">
                    <tr>
                        <th></th>
                        <th>{{ trans('jellies::material.attribute.name') }}</th>
                        <th>{{ trans('jellies::material.attribute.quantity') }}</th>
                    </tr>

                    @foreach ($model->materials as $model)
                        <tr onclick="window.open('{{ route('material.show', $model->id) }}', '_self')">
                            <td>
                                <span class="game-icon game-icon-vile-fluid"></span>
                            </td>
                            <td>
                                <a href="{{ route('material.show', $model->id) }}">
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
        <span class="fa fa-info-circle"></span> {{ trans('jellies::user.show.help') }}
    </div>
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::user.show.help') }}
    </div>
@endsection
