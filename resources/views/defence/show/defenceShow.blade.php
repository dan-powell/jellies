@extends('jellies::attack.attackBase')

@section('main')

    <h1>
        <span class="game-icon game-icon-slime"></span>
        <small>
            {{ trans('jellies::attack.attribute.succesful') }} {{ $model->successful }}
        </small>
    </h1>

@endsection

@section('help')
    @parent
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::attack.show.help') }}
    </div>
    <div class="alert alert-info">
        <span class="fa fa-info-circle"></span> {{ trans('jellies::attack.show.help') }}
    </div>
@endsection
