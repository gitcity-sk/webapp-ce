<?php

use Faker\Generator as Faker;

$factory->define(App\Group::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'name' => $faker->sentence,
        'image' => $faker->sentence,
        'description' => $faker->paragraph 
    ];
});