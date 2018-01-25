<?php

use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'image' => $faker->sentence,
        'description' => $faker->paragraph,
        'twitter' => $faker->sentence,
        'facebook' => $faker->sentence,
        'verified' => true
    ];
});