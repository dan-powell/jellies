<?php

$factory->define(DanPowell\Jellies\Models\Game\Enemy::class, function (Faker\Generator $faker) {

    // Use Nubs random name generator for cool names :)
    $randomNameGen = new \Nubs\RandomNameGenerator\All(
        [
            new \Nubs\RandomNameGenerator\Alliteration(),
            new \Nubs\RandomNameGenerator\Vgng()
        ]
    );

    // Generate the stats
    $points = $faker->numberBetween(config('jellies.enemy.points.min'), config('jellies.enemy.points.max'));
    $stats_array = config('jellies.enemy.stats');
    $distribution = Utilities::distributePoints(count($stats_array), $points);
    $stats = [];
    for($i = 0; $i < count($stats_array); $i++) {
        $stats[$stats_array[$i]] = $distribution[$i];
    }

    $max_hp = $faker->numberBetween(10, 100);

    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),

        'name' => $randomNameGen->getName(),

        'attack' => $stats['attack'],
        'defence' => $stats['defence'],
        'initiative' => $stats['initiative'],
        'health' => $stats['health'],

        'hp' => $stats['health'],
    ];
});
