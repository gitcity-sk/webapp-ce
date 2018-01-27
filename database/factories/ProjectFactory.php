<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    $name = $faker->sentence;
    return [
        'user_id' => function() {
            $u =  factory(App\User::class)->create();
            $u->profile()->save(factory(App\Profile::class)->make());
            return $u;
        },
        'name' => $name,
        'slug' => str_slug($name),
        'description' => $faker->paragraph
    ];
});
