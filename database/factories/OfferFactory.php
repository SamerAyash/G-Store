<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Offer;
use Faker\Generator as Faker;

$factory->define(Offer::class, function (Faker $faker) {
    return [
        'discount'=>$faker->numberBetween(5,90),
        'duration'=>$faker->numberBetween(1,30),
        'seller_id'=>\App\User::where('type','seller')->inRandomOrder()->first()->id,
        'product_id'=>\App\Product::inRandomOrder()->first()->id,
    ];
});
