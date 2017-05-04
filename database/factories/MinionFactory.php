<?php


$factory->define(DanPowell\Jellies\Models\Game\Miniontype::class, function (Faker\Generator $faker) {

    // Use Nubs random name generator for cool names :)
    $randomNameGen = new \Nubs\RandomNameGenerator\All(
        [
            new \Nubs\RandomNameGenerator\Alliteration(),
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
	    'name' => $randomNameGen->getName(),
        'attack' => $stats['attack'],
        'defence' => $stats['defence'],
        'initiative' => $stats['initiative'],
        'health' => $stats['health'],
        'cost' => $points,
    ];
});

$factory->state(DanPowell\Jellies\Models\Game\Miniontype::class, 'basic', function ($faker) {
    return [
        'attack' => 5,
        'defence' => 5,
        'initiative' => 5,
        'health' => 5,
        'cost' => 0,
    ];
});

$factory->state(DanPowell\Jellies\Models\Game\Miniontype::class, 'knight', function ($faker) {
    return [
        'attack' => 25,
        'defence' => 25,
        'initiative' => 25,
        'health' => 25,
        'cost' => 80,
    ];
});



$factory->define(DanPowell\Jellies\Models\Game\Minion::class, function (Faker\Generator $faker) {

    $health = $faker->numberBetween(config('jellies.minion.points.min'), config('jellies.minion.points.max'));

    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),

	    'name' => $faker->firstname(),

        'miniontype_id' => null,

        'attack' => $faker->numberBetween(config('jellies.minion.points.min'), config('jellies.minion.points.max')),
        'defence' => $faker->numberBetween(config('jellies.minion.points.min'), config('jellies.minion.points.max')),
        'initiative' => $faker->numberBetween(config('jellies.minion.points.min'), config('jellies.minion.points.max')),
        'health' => $health,

        'hp' => $health,

    ];
});
