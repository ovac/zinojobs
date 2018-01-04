<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Invitation::class, function (Faker $faker) {
    return [
        'job_id' => rand(1, 1000),
        'host_id' => rand(1, 1000),
        'user_id' => rand(1, 100),
        'location' => $faker->address(),
        'note' => $faker->realText(),
        'time' => Carbon::now()->addWeeks(rand(1, 52))->format('Y-m-d H:i:s'),
    ];
});
