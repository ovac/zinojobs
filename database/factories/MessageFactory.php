<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 2),
        'application_id' => rand(1, 1000),
        'message' => $faker->realText(50, 2),
    ];
});
