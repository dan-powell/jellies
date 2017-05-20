@if(isset($realms) && count($realms))
    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>{{ trans('jellies::realm.attribute.name') }}</th>
        </tr>

        @foreach ($realms as $model)
            <tr onclick="window.open('{{ route('realm.show', $model->id) }}', '_self')">
                <td>
                    <span class="fa fa-globe fa-2x"></span>
                </td>
                <td>
                    <a href="{{ route('realm.show', $model->id) }}">
                        {{ $model->name }}
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@endif
