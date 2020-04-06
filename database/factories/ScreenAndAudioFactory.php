<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Products\ScreenAndAudio;
use Faker\Generator as Faker;

$factory->define(ScreenAndAudio::class, function (Faker $faker) {
    return [
        'displaySize'=>$faker->randomFloat(2,4,10),
        'type'=>$faker->randomElement(['screen','audio']),
    ];
});
