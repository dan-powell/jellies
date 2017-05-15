@if(isset($users) && count($users))
    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>{{ trans('jellies::user.attribute.name') }}</th>
            <th>{{ trans('jellies::user.attribute.level') }}</th>
        </tr>

        @foreach ($users as $model)
            <tr onclick="window.open('{{ route('user.show', $model->id) }}', '_self')">
                <td>
                    <span class="game-icon game-icon-vile-fluid"></span>
                </td>
                <td>
                    <a href="{{ route('user.show', $model->id) }}">
                        {{ $model->name }}
                    </a>
                </td>
                <td><span class="badge bg-blue">{{ $model->level }}</span></td>
            </tr>
        @endforeach
    </table>

@endif
