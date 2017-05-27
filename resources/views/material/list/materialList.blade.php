@if(isset($models) && count($models))
    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>{{ trans('jellies::material.attribute.name') }}</th>
            <th>{{ trans('jellies::material.attribute.effective') }}</th>
            <th>{{ trans('jellies::material.attribute.ineffective') }}</th>
            <th>{{ trans('jellies::material.attribute.modifiers') }}</th>
        </tr>

        @foreach ($models as $model)
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
                    {{ count($model->effective) }}
                </td>
                <td>
                    {{ count($model->ineffective) }}
                </td>
                <td>
                    {{ count($model->modifiers) }}
                </td>
            </tr>
        @endforeach
    </table>

@endif
