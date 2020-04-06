<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Products\SportAndGames;
use Faker\Generator as Faker;

$factory->define(SportAndGames::class, function (Faker $faker) {
    return [
        'for'=>$faker->randomElement(['boy','girl','both']),
        'age'=>$faker->numberBetween(1,15)
    ];
});
