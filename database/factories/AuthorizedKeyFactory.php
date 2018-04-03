<?php

use Faker\Generator as Faker;

$factory->define(App\AuthorizedKey::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'title' => $faker->sentence,
        'public_key' => $faker->paragraph
    ];
});
