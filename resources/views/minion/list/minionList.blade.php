@if(isset($minions) && count($minions))
    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>{{ trans('jellies::minion.name') }}</th>
            <th>{{ trans('jellies::minion.level') }}</th>
            <th>{{ trans('jellies::minion.health') }}</th>
            <th>{{ trans('jellies::minion.active') }}</th>
        </tr>
        @foreach ($minions as $model)
        <tr onclick="window.open('{{ route('minion.show', $model->id) }}', '_self')">
            <td>
                <span class="fa fa-user"></span>
            </td>
            <td>
                <a href="{{ route('minion.show', $model->id) }}">
                    {{ $model->fullname }}
                </a>
            </td>
            <td><span class="badge bg-blue">{{ $model->level }}</span></td>
            <td>
                <span class="badge bg-red">{{ $model->hp }} / {{ $model->health }}</span>
                <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-danger" style="width: {{ $model->hp/ $model->health * 100 }}%;">
                    </div>
                </div>
            </td>
            <td>
                @if(isset($model->active) && $model->active)
                    <span class="badge bg-default">{{ trans('jellies::minion.active') }}</span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
@endif
