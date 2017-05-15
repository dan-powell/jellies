@if(isset($models) && count($models))
    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>{{ trans('jellies::modifier.attribute.attribute') }}</th>
            <th>{{ trans('jellies::modifier.attribute.adjustment') }}</th>
            <th>{{ trans('jellies::modifier.attribute.value') }}</th>
        </tr>

        @foreach ($models as $model)
            <tr>
                <td>
                    <span class="game-icon game-icon-vile-fluid"></span>
                </td>
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
