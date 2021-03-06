<?php


$factory->define(DanPowell\Jellies\Models\User::class, function (Faker\Generator $faker) {

    return [
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
	    'name' => $faker->name(),
        'email' => $faker->safeEmail(),
        'password' => bcrypt('password'),
    ];

});

$factory->state(DanPowell\Jellies\Models\User::class, 'test', function ($faker) {
    return [
        'name' => 'Test User',
        'email' => 'test@example.com',
    ];
});

$factory->state(DanPowell\Jellies\Models\User::class, 'new', function ($faker) {
    return [
        'name' => 'New User',
        'email' => 'new@example.com'
    ];
});

$factory->state(DanPowell\Jellies\Models\User::class, 'npc', function ($faker) {
    return [
        'npc' => true
    ];
});
