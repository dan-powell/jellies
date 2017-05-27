<?php

$factory->define(DanPowell\Jellies\Models\Game\Material::class, function (Faker\Generator $faker) {
    return [
	    'name' => $faker->firstname(),
    ];
});
