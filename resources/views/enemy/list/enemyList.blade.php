@if(isset($enemies) && count($enemies))
    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>{{ trans('jellies::enemy.attribute.name') }}</th>
            <th>{{ trans('jellies::enemy.attribute.level') }}</th>
            @foreach(config('jellies.enemy.stats') as $stat)
                <th>{{ trans('jellies::enemy.attribute.' . $stat) }}</th>
            @endforeach
        </tr>

        @foreach ($enemies as $model)
            <tr onclick="window.open('{{ route('enemy.show', $model->id) }}', '_self')">
                <td>
                    <span class="fa fa-user"></span>
                </td>
                <td>
                    <a href="{{ route('enemy.show', $model->id) }}">
                        {{ $model->name }}
                    </a>
                </td>
                <td><span class="badge bg-blue">{{ $model->level }}</span></td>
                @foreach ($model->stats as $stat)
                    <td><span class="badge bg-default">{{ $stat }}</span></td>
                @endforeach
            </tr>
        @endforeach
    </table>
@endif
