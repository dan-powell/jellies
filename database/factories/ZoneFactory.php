<?php

$factory->define(DanPowell\Jellies\Models\Game\Zone::class, function (Faker\Generator $faker) {

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
        'size' => $faker->numberBetween(config('jellies.realm.zone.size.min'), config('jellies.realm.zone.size.max'))
    ];
});
