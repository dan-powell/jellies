<?php

$factory->define(DanPowell\Jellies\Models\Game\Modifier::class, function (Faker\Generator $faker) {

    $adjustment = $faker->randomElement(['+', '-', '+%', '-%']);

    switch ($adjustment) {
        case '+':
            $value = $faker->numberBetween(1, 10);
            break;
        case '-':
            $value = $faker->numberBetween(1, 10);
            break;
        case '+%':
            $value = $faker->numberBetween(10, 300);
            break;
        case '-%':
            $value = $faker->numberBetween(5, 20);
            break;
    }

    return [
        'attribute' => $faker->randomElement(config('jellies.minion.stats')),
        'adjustment' => $adjustment,
        'value' => $value
    ];
});
