<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'job_id' => rand(1, 100),
        'requirement' => rand(0, 1),
        'type' => array_random([
            'boolean',
            'string',
            'range',
            'objective',
        ]),
        'question' => array_random([
            'Can you work under pressure?',
            'Do you work well under pressure?',
            'Have you done your NYSC?',
            'Do you have the required years of working experience?',
            'Are you ready to put this company before your own personal interests?',
            'Are you okay with the amount of travel required for this position?',
            'Do you handle criticism well?',
            'Have you done anything to enhance your skillset?',
            'Are you a team player?',
            'Do you keep a notebook for your ideas?',
            'If the world you draw really existed, would you like to go visit it?',
            'Are you a goal-oriented employee?',
            'Do you manage pressure well?',
            'Do you manage conflict well?',
            'Is there another occupation you would like to try instead?',
            'Do you take good care of your things and use them for a long time?',
            'Do you like children?',
            'Do you have a pet?',
            'Do you pay attention to the ecology?',
            'Do you immediately trust people?',
        ]),
    ];
});
