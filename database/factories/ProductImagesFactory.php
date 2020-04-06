<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductImages;
use Faker\Generator as Faker;

$factory->define(ProductImages::class, function (Faker $faker) {
    return [
/*        'name'=>$faker->image('public/images/products',640,480,null,false),*/
        'name'=>'iphone11.png',
    ];
});
