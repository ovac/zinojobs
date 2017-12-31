<?php

use Faker\Generator as Faker;

$factory->define(App\Job::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle(),
        'description' => $faker->text(),
        'salary' => rand(1, 1000000),
        'company_id' => rand(1, 100),
    ];
});
