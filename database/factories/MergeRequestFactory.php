<?php

use Faker\Generator as Faker;

$factory->define(App\MergeRequest::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'project_id' => function () {
            return factory('App\Project')->create()->id;
        },
        'branch_from' => 'develop',
        'branch_to' => 'master',
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'complete' => false
    ];
});
