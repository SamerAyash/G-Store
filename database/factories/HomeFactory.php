<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Products\Home;
use Faker\Generator as Faker;

$factory->define(Home::class, function (Faker $faker) {
    return [
        'size'=>$faker->randomDigit,
        'deliver'=>$faker->boolean,
        'material'=>$faker->randomElement(['wood','stainless steel','plastic']),
    ];
});
