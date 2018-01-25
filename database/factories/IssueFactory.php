<?php

use Faker\Generator as Faker;

$factory->define(App\Issue::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            $u =  factory(App\User::class)->create();
            $u->profile()->save(factory(App\Profile::class)->make());
            return $u;
        },
        'project_id' => function() {
            return factory(App\Project::class)->create()->id;
        },
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'complete' => false
    ];
});
