<?php

$factory->define(DanPowell\Jellies\Models\Game\Modifier::class, function (Faker\Generator $faker) {
    return [
        'attribute' => $faker->randomElement(config('jellies.minion.stats')),
        'adjustment' => $faker->randomElement(['+', '*', '-', '/', '%+', '%-']),
        'value' => $faker->numberBetween(1, 10),
    ];
});
