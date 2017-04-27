@if(isset($messages) && !empty($messages))
<!-- Messages: style can be found in dropdown.less-->
<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-envelope-o"></i>
        <span class="label label-success">{{ count($messages) }}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">You have {{ count($messages) }} messages</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">

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
        </li>
    </ul>
</li>
@endif
