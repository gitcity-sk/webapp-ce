<?php

use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'name' => $faker->name,
        'image' => $faker->sentence,
        'description' => $faker->paragraph,
        'twitter' => $faker->sentence,
        'facebook' => $faker->sentence,
        'verified' => true
    ];
});
