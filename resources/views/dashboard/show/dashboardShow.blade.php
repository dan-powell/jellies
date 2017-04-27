@extends('jellies::layout.basic.layoutBasic')

@section('body')

    <section class="content">

        <div class="row">
            <div class="col-sm-4">

                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="game-icon"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-number">{{ count($incursions) }}</span>
                        <span class="info-box-text">Active Incursions</span>

                        <span class="progress-description"></span>
                    </div>
                </div>

            </div>
            <div class="col-sm-4">

                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="game-icon"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-number">{{ count($minions) }}</span>
                        <span class="info-box-text">Minions</span>

                        <span class="progress-description"></span>
                    </div>
                </div>

            </div>
            <div class="col-sm-4">

                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="game-icon"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-number">{{ auth()->user()->points }}</span>
                        <span class="info-box-text">Souls</span>

                        <span class="progress-description"></span>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">

                <a href="{{ route('minion.index') }}" class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="game-icon"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-number">Summon new minions</span>
                        <span class="progress-description"></span>
                    </div>
                </a>

            </div>
            <div class="col-sm-6">

                <a href="{{ route('incursion.create') }}" class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="game-icon"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-number">Create new incursion</span>
                        <span class="progress-description"></span>
                    </div>
                </a>

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

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Leaderboard (Top 10)</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped table-hover">
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
                    <!-- /.box-body -->
                </div>

            </div>

        </div>


    </section>

@endsection
