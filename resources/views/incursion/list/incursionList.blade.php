@if(isset($incursions) && count($incursions))
    <table class="table table-striped table-hover">
        <tr>
            <th>{{ trans('jellies::incursion.date_start') }}</th>
            <th>{{ trans('jellies::incursion.progress') }}</th>
            <th>{{ trans('jellies::game.points') }}</th>
        </tr>

        @foreach ($incursions as $model)

            <tr onclick="window.open('{{ route('incursion.show', $model->id) }}', '_self')">
                <td>
                    <a href="{{ route('incursion.show', $model->id) }}">
                        {{ $model->created_at->format(config('jellies.ui.date_time_format')) }}
                    </a>
                </td>
                <td>
                    {{ count($model->encounters) }}
                    {{ trans_choice('jellies::encounter.sentence', count($model->encounters))}}
                </td>
                <td>
                    {{ $model->points }}
                    {{ trans_choice('jellies::game.point', $model->points)}}
                </td>
            </tr>
        @endforeach
    </table>
@else
    <h3>No incursions to show</h3>
@endif
