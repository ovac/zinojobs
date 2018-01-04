<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Job::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle(),
        'description' => $faker->text(),
        'salary' => rand(1, 1000000),
        'location' => $faker->address,
        'company_id' => rand(1, 100),
        'user_id' => rand(1, 100),
        'closing' => Carbon::now()->addWeeks(rand(1, 52))->format('Y-m-d H:i:s'),
    ];
});
