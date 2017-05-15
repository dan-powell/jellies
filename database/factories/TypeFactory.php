<?php

$factory->define(DanPowell\Jellies\Models\Game\Type::class, function (Faker\Generator $faker) {
    return [
	    'name' => $faker->firstname(),
    ];
});
