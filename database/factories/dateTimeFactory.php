<?php

use Faker\Generator as Faker;

$factory->define(App\GoodDate::class, function (Faker $faker) {
    return [
        'userId'=>1,
        'type'=>1,
        'goodDate'=>$faker->dateTime('now'),

    ];
});
