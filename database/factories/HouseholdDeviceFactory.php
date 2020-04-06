<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Products\HouseholdDevice;
use Faker\Generator as Faker;

$factory->define(HouseholdDevice::class, function (Faker $faker) {
    return [
        'type'=>$faker->randomElement(['cooktops','coffee machine','food processor','blender',
            'air fryer','kettle','water dispenser','mixer','waffle maker','iron','fan'
            ,'sewing machine','oven & toaster','microwave','washing machine','refrigerator'])
    ];
});
