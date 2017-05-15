@if(isset($models) && count($models))
    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>{{ trans('jellies::defence.attribute.attacker') }}</th>
            <th>{{ trans('jellies::defence.attribute.successful') }}</th>
        </tr>

        @foreach ($models as $model)
            <tr onclick="window.open('{{ route('defence.show', $model->id) }}', '_self')">
                <td>
                    <span class="game-icon game-icon-vile-fluid"></span>
                </td>
                <td>
                    <a href="{{ route('defence.show', $model->id) }}">
                        {{ $model->attacker->name }}
                    </a>
                </td>
                <td>
                    {{ $model->successful }}
                </td>
            </tr>
        @endforeach
    </table>

@endif
