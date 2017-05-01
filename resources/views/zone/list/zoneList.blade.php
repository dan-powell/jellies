@if(isset($zones) && count($zones))
    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>{{ trans('jellies::zone.attribute.name') }}</th>
        </tr>

        @foreach ($zones as $model)
            <tr onclick="window.open('{{ route('zone.show', $model->id) }}', '_self')">
                <td>
                    <span class="game-icon game-icon-annexation fa-2x"></span>
                </td>
                <td>
                    <a href="{{ route('zone.show', $model->id) }}">
                        {{ $model->name }}
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@endif
