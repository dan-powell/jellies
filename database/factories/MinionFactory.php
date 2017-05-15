<?php

$factory->define(DanPowell\Jellies\Models\Game\Minion::class, function (Faker\Generator $faker) {

    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTime('now'),

	    'name' => $faker->firstname(),

    ];
});
