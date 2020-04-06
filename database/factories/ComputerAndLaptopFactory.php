<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Products\ComputerAndLaptop;
use Faker\Generator as Faker;

$factory->define(ComputerAndLaptop::class, function (Faker $faker) {
    return [
        'displaySize'=>$faker->randomFloat(2,4,10),
        'processor'=>$faker->randomElement(['core i3','core i5','core i7','core i9']),
        'diskSize'=>$faker->randomElement([120,160,240,500,1000]),
        'ssdSize'=>$faker->randomElement([120,160,240,500,1000]),
        'ram'=>$faker->randomElement([2,4,8,16,32,64]),
        'type'=>$faker->randomElement(['computer','laptop']),
    ];
});
