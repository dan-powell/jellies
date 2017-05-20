@if(isset($incursions) && count($incursions))
    <table class="table table-striped table-hover">
        <tr>
            <th>{{ trans('jellies::incursion.attribute.created_at') }}</th>
            <th>{{ trans('jellies::incursion.attribute.encounters') }}</th>
            <th>{{ trans('jellies::incursion.attribute.points') }}</th>
        </tr>

        @foreach ($incursions as $model)

            <tr onclick="window.open('{{ route('incursion.show', $model->id) }}', '_self')">
                <td>
                    <a href="{{ route('incursion.show', $model->id) }}">
                        {{ $model->created_at->format(config('jellies.ui.date_time_format')) }}
                    </a>
                </td>
                <td>
                    <span class="game-icon game-icon-sword-clash"></span> {{ count($model->encounters) }}
                </td>
                <td>
                    <span class="fa fa-star"></span> {{ $model->points }}
                </td>
            </tr>
        @endforeach
    </table>
@endif
