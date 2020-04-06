<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Products\BeautyAndHelth;
use Faker\Generator as Faker;

$factory->define(BeautyAndHelth::class, function (Faker $faker) {
    return [
        'size'=>$faker->randomDigit,
        'for'=>$faker->randomElement(['men','women','both']),
        'power'=>null,
    ];
});
