<?php

$factory->define(DanPowell\Jellies\Models\Ui\Message::class, function (Faker\Generator $faker) {

    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),

        'subject' => $faker->sentence(),
	    'message' => $faker->paragraph(2),
        'type' => $faker->randomElement(config('jellies.ui.messages.types')),
        'read' => $faker->randomElement([true, false]),
    ];
});
