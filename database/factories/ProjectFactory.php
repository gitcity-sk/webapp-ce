<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    $name = $faker->sentence;
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'name' => $name,
        'slug' => str_slug($name),
        'description' => $faker->paragraph
    ];
});
