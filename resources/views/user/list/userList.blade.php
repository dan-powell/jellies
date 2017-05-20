@if(isset($users) && count($users))
    <table class="table table-striped table-hover">
        <tr>
            <th>{{ trans('jellies::user.attribute.name') }}</th>
            <th>{{ trans('jellies::user.attribute.minions') }}</th>
            <th>{{ trans('jellies::user.attribute.points') }}</th>
            @if(isset($details) && $details)
            <th>{{ trans('jellies::user.attribute.attacks') }}</th>
            <th>{{ trans('jellies::user.attribute.defences') }}</th>
            @endif
        </tr>

        @foreach ($users as $model)
            <tr onclick="window.open('{{ route('user.show', $model->id) }}', '_self')">
                <td>
                    <a href="{{ route('user.show', $model->id) }}">
                        {{ $model->name }}
                    </a>
                </td>
                <td><span class="badge">{{ count($model->minions) }}</span></td>
                <td><span class="badge">{{ $model->points }}</span></td>
                @if(isset($details) && $details)
                <td><span class="badge">
                    @if(count(auth()->user()->attacks->where('defender_id', $model->id)))
                        {{ count(auth()->user()->attacks->where('defender_id', $model->id)) }}
                    @endif
                </span></td>
                <td><span class="badge">
                    @if(count(auth()->user()->defences->where('attacker_id', $model->id)))
                        {{ count(auth()->user()->defences->where('attacker_id', $model->id)) }}
                    @endif
                </span></td>
                @endif
            </tr>
        @endforeach
    </table>

@endif
