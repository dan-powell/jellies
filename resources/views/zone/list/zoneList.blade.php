@if(isset($models) && count($models))
    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>{{ trans('jellies::zone.attribute.number') }}</th>
            <th>{{ trans('jellies::zone.attribute.name') }}</th>
            <th>{{ trans('jellies::zone.attribute.size') }}</th>
            <th>{{ trans('jellies::zone.attribute.level') }}</th>
        </tr>

        @foreach ($models as $model)
            <tr onclick="window.open('{{ route('zone.show', $model->id) }}', '_self')">
                <td>
                    <span class="fa fa-cloud fa-2x"></span>
                </td>
                <td>
                    {{ $model->number }}
                </td>
                <td>
                    <a href="{{ route('zone.show', $model->id) }}">
                        {{ $model->name }}
                    </a>
                </td>
                <td>
                    {{ $model->size }}
                </td>
                <td>
                    {{ $model->level }}
                </td>
            </tr>
        @endforeach
    </table>
@endif
