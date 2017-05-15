@if(isset($models) && count($models))
    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>{{ trans('jellies::attack.attribute.defender') }}</th>
            <th>{{ trans('jellies::attack.attribute.successful') }}</th>
        </tr>

        @foreach ($models as $model)
            <tr onclick="window.open('{{ route('attack.show', $model->id) }}', '_self')">
                <td>
                    <span class="game-icon game-icon-vile-fluid"></span>
                </td>
                <td>
                    <a href="{{ route('attack.show', $model->id) }}">
                        {{ $model->defender->name }}
                    </a>
                </td>
                <td>
                    {{ $model->successful }}
                </td>
            </tr>
        @endforeach
    </table>

@endif
