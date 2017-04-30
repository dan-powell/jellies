@extends('jellies::base')

@section('main')

    <section class="content">

        <div class="row">
            <div class="col-sm-4">
                <div class="alert alert-success">
                    <i class="game-icon game-icon-swordman"></i>
                    {{ count($incursions) }} {{ trans_choice('jellies::incursion.plural', count($incursions)) }}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="alert alert-info">
                    <i class="game-icon game-icon-slime"></i>
                    {{ count($minions) }} {{ trans_choice('jellies::minion.plural', count($minions)) }}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="alert alert-info">
                    <i class="fa fa-star"></i>
                     {{ auth()->user()->points }} {{ trans_choice('jellies::game.points', auth()->user()->points) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">

                <div class="box box-blue">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('jellies::incursion.title_active') }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        @include('jellies::incursion.list.incursionList', ['incursions' => $incursions])
                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <span class="info-box-icon"><i class="fa fa-envelope"></i></span>
                    <div class="widget-user-header bg-yellow">
                        <h3 class="widget-user-username">Messages</h3>
                        <br/>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">

                            @foreach($messages as $message)
                                <li><!-- start message -->
                                    <a href="{{ route('message.show', $message->id) }}" class="bg-{{ $message->type }}">
                                        <div class="pull-left">

                                        </div>
                                        <h4>
                                            @if(!$message->read)
                                                <strong>
                                            @endif
                                                {{ $message->type }}
                                            @if(!$message->read)
                                                </strong>
                                            @endif

                                            <small><i class="fa fa-clock-o"></i> {{ $message->created_at->format('d M Y') }}</small>
                                        </h4>
                                        <p>{{ $message->subject }}</p>
                                    </a>
                                </li>
                                <!-- end message -->
                            @endforeach

                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-sm-6">

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Leaderboard (Top 10)</h3>
                    </div>

                    <table class="table">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Souls</th>
                        </tr>
                        @foreach ($leaderboard as $user)
                            <tr>
                                <td>
                                    <span class="fa fa-user"></span>
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    <span class="badge bg-blue">{{ $user->points }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>

            </div>

        </div>


    </section>

@endsection

@section('sidebar')
    <h2>Actions</h2>
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="">
            <a href="{{ route('minion.create') }}">{{ trans('jellies::minion.create.action') }}</a>
        </li>
        <li role="presentation" class="">
            <a href="{{ route('incursion.create') }}">{{ trans('jellies::incursion.create.action') }}</a>
        </li>
    </ul>
@endsection
