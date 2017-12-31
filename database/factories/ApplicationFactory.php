<?php

use Faker\Generator as Faker;

$factory->define(App\Application::class, function (Faker $faker) {
    return [
        'resume' => 'https://uptowork.com/mycv/ovac4u',
        'user_id' => rand(1, 100),
        'job_id' => rand(1, 100),
    ];
});
