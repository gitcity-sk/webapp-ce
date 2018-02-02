<?php

use Faker\Generator as Faker;

$factory->define(App\Group::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            $u =  factory(App\User::class)->create();
            $u->profile()->save(factory(App\Profile::class)->make());
            return $u;
        },
        'name' => $faker->sentence,
        'image' => $faker->sentence,
        'description' => $faker->paragraph 
    ];
});