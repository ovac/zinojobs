<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {

    return [
        'name' => $companyName = $faker->company(),
        'industry' => $faker->jobTitle(),
        'address' => $faker->address(),
        'employees' => rand(1, 10000),
        'details' => $faker->realText(),
        'mission' => $faker->catchPhrase(),
        'logo' => str_replace('#', '',
            'https://dummyimage.com/' .
            $faker->numberBetween(400, 800) . 'x' . $faker->numberBetween(400, 600) . '/' .
            $faker->hexColor . '/' . $faker->hexColor . '.png&text=' .
            $companyName
        ),
    ];
});
