@if(isset($minions) && count($minions))
    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>{{ trans('jellies::minion.attribute.name') }}</th>
            <th>{{ trans('jellies::minion.attribute.level') }}</th>
        </tr>

        @foreach ($minions as $model)
            <tr onclick="window.open('{{ route('minion.show', $model->id) }}', '_self')">
                <td>
                    <span class="fa fa-paw fa-2x"></span>
                </td>
                <td>
                    <a href="{{ route('minion.show', $model->id) }}">
                        {{ $model->name }}
                    </a>
                </td>
                <td>
                    {{ $model->level }}
                </td>
            </tr>
        @endforeach
    </table>

@endif
