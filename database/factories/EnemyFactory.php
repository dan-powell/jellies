<?php

$factory->define(DanPowell\Jellies\Models\Game\Enemy::class, function (Faker\Generator $faker) {

    // Use Nubs random name generator for cool names :)
    $randomNameGen = new \Nubs\RandomNameGenerator\All(
        [
            new \Nubs\RandomNameGenerator\Alliteration(),
            new \Nubs\RandomNameGenerator\Vgng()
        ]
    );

    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),

        'name' => $randomNameGen->getName(),

        'attack' => 1,
        'defence' => 1,
        'initiative' => 1,
        'health' => 1,

        'hp' => 1,
    ];
});
