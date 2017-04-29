@if(isset($minions) && count($minions))
    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>{{ trans('jellies::minion.attribute.name') }}</th>
            <th>{{ trans('jellies::minion.attribute.level') }}</th>
            <th>{{ trans('jellies::minion.attribute.hp') }}</th>
            <th>{{ trans('jellies::minion.attribute.active') }}</th>
        </tr>
        @foreach ($minions as $model)
            <tr onclick="window.open('{{ route('minion.show', $model->id) }}', '_self')">
                <td>
                    <span class="game-icon game-icon-vile-fluid"></span>
                </td>
                <td>
                    <a href="{{ route('minion.show', $model->id) }}">
                        {{ $model->name }}
                    </a>
                </td>
                <td><span class="badge bg-blue">{{ $model->level }}</span></td>
                <td>
                    <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-danger" style="width: {{ $model->hp/ $model->health * 100 }}%;">{{ $model->hp }} / {{ $model->health }}
                        </div>
                    </div>
                </td>
                <td>
                    @if(isset($model->active) && $model->active)
                        <span class="game-icon game-icon-swordman fa-lg"></span>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

@endif
