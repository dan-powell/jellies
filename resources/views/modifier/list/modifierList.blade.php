@if(isset($models) && count($models))
    <table class="table table-striped table-hover">
        <tr>
            <th>{{ trans('jellies::modifier.attribute.attribute') }}</th>
            <th>{{ trans('jellies::modifier.attribute.adjustment') }}</th>
            <th>{{ trans('jellies::modifier.attribute.value') }}</th>
        </tr>

        @foreach ($models as $model)
            <tr>
                <td>
                    {{ $model->attribute }}
                </td>
                <td>
                    {{ $model->adjustment }}
                </td>
                <td>
                    {{ $model->value }}
                </td>
            </tr>
        @endforeach
    </table>

@endif
