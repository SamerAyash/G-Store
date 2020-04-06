<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Products\MobileAndTablet;
use Faker\Generator as Faker;

$factory->define(MobileAndTablet::class, function (Faker $faker) {
    return [
        'ram'=>$faker->randomElement([2,4,8,16,32]),
        'storage'=>$faker->randomElement([4,8,16,32,64,128]),
        'sim'=>$faker->randomElement(['single','dual']),
        'battery'=>$faker->randomElement([3000,3500,4000,4500,5000,5500,6000]),
        'displaySize'=>$faker->randomFloat(2,4,10),
        'backCamera'=>$faker->randomElement([4,8,16,32,40,64,48,108]),
        'rearCamera'=>$faker->randomElement([6,8,16,20,40,32,48]),
    ];
});
