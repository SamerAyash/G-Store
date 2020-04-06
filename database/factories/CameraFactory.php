<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Products\Camera;
use Faker\Generator as Faker;

$factory->define(Camera::class, function (Faker $faker) {
    return [
        'zoom'=>$faker->randomDigit,
        'precision'=>$faker->safeHexColor
    ];
});
