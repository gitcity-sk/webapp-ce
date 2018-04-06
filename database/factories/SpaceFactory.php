<?php

use Faker\Generator as Faker;

$factory->define(App\Space::class, function (Faker $faker) {
    $name = $faker->sentence;

    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'project_id' => function () {
            return factory('App\Project')->create()->id;
        },
        'name' => $name,
        'slug' => str_slug($name),
        'private' => false,

    ];
});
