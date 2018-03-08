<?php

use Faker\Generator as Faker;

$factory->define(App\Milestone::class, function (Faker $faker) {
    return [
        'project_id' => function () {
            return factory('App\Project')->create()->id;
        },
        'group_id' => function () {
            return factory('App\Group')->create()->id;
        },
        'title' => $faker->sentence,
        'description' => $faker->paragraph
    ];
});
