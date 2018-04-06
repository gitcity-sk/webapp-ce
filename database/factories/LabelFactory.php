<?php

use Faker\Generator as Faker;

$factory->define(App\Label::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'color' => $faker->sentence,
        'description' => $faker->sentence
    ];
});
