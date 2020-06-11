<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'description'=>$faker->text,
        'mainImage'=>$faker->randomElement(['eighth.jpg','fifth.jpg','fourth.jpg','second.jpg',
            'seventh.jpg','sixth.jpg','iphone.jpg','1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg',
            '9.jpg','10.jpg','11.jpg','12.jpg','13.jpg','14.jpg','16.jpg','17.jpg','18.jpg','20.jpg','21.jpg',
            '22.jpg','23.jpg','24.jpg','25.jpg','26.jpg','27.jpg','28.jpg','29.jpg','30.jpg','31.jpg','32.jpg','33.jpg',
            '34.jpg','35.jpg','36.jpg','37.jpg','38.jpg','39.jpg','40.jpg','41.jpg','42.jpg','43.jpg','44.jpg','45.jpg',
            '46.jpg','47.jpg','48.jpg','49.jpg','50.jpg','51.jpg','52.jpg','53.jpg','54.jpg','55.jpg','56.jpg','57.jpg',
            '58.jpg','59.jpg','60.jpg','61.jpg','62.jpg','63.jpg','64.jpg','65.jpg','67.jpg','68.jpg','69.jpg','70.jpg',
            '71.jpg','72.jpg','73.jpg','74.jpg','75.jpg','76.jpg','77.jpg','78.jpg','79.jpg','80.jpg','81.jpg','82.jpg',
            '83.jpg','84.jpg','86.jpg','87.jpg','88.jpg','89.jpg','90.jpg',]),
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
