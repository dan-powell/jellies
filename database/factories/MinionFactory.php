<?php

$factory->define(DanPowell\Jellies\Models\Game\Minion::class, function (Faker\Generator $faker) {

    // Use Nubs random name generator for cool names :)
    $randomNameGen = new \Nubs\RandomNameGenerator\All(
        [
            new \Nubs\RandomNameGenerator\Alliteration(),
            new \Nubs\RandomNameGenerator\Vgng()
        ]
    );

    // Generate the stats
    $points = $faker->numberBetween(config('jellies.minion.points.min'), config('jellies.minion.points.max'));
    $stats_array = config('jellies.minion.stats');
    $distribution = Utilities::distributePoints(count($stats_array), $points);
    $stats = [];
    for($i = 0; $i < count($stats_array); $i++) {
        $stats[$stats_array[$i]] = $distribution[$i] +1;
    }

    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),

	    'name' => $faker->firstname(),

        'attack' => $stats['attack'],
        'defence' => $stats['defence'],
        'initiative' => $stats['initiative'],
        'health' => $stats['health'],

        'hp' => $stats['health'],

    ];
});
