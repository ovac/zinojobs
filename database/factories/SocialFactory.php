<?php

use Faker\Generator as Faker;

$factory->define(App\Social::class, function (Faker $faker) {
    $username = $faker->username();
    return [
        'facebook' => array_random([null, 'http://www.facebook.com/' . $username]),
        'google' => array_random([null, 'http://www.google.com/' . $username]),
        'linkedin' => array_random([null, 'http://www.inkedin.com/in' . $username]),
        'twitter' => array_random([null, 'http://www.twitter.com/' . $username]),
        'instagram' => array_random([null, 'http://www.instagram.com/' . $username]),
        'github' => array_random([null, 'http://www.github.com/' . $username]),
        'youtube' => array_random([null, 'http://www.youtube.com/' . $username]),
        'website' => array_random([null, 'http://www.website.com/' . $username]),
    ];
});
