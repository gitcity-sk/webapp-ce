<?php

use Faker\Generator as Faker;

$factory->define(App\Page::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'project_id' => function () {
            return factory('App\Project')->create()->id;
        },
        'title' => $title,
        'slug' => str_slug($title),
        'description' => $faker->paragraph
    ];
});
