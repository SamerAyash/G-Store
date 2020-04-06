<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title'=>$faker->title,
        'description'=>$faker->text,
        'mainImage'=>'iphone.jpg',
        'price'=>$faker->randomFloat(2,0,400),
        'amount'=>$faker->randomDigit,
        'rate'=>$faker->numberBetween(0,5),
        'ratingCount'=>$faker->numberBetween(0,500),
        'brand'=>$faker->company,
        'isAccept'=>$faker->randomElement([true,false]),
        'note'=>$faker->randomElement([null,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sollicitudin erat a
        ipsum accumsan commodo. Fusce fermentum quis ex sit amet vestibulum.'
        ,'Sed at dictum felis. Donec pretium ornare mauris. Duis ut magna aliquam, maximus est nec, consequat velit.
        Donec quis metus ante. Ut quis gravida libero. Suspendisse potenti. Cras et odio condimentum nulla aliquam mollis.'
        ])
    ];
});
