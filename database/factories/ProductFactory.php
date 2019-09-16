<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'price' => $faker->numberBetween(4,8),
        'discount' => $faker->numberBetween(0,99),
        'description' => $faker->text,
        'count' => $faker->numberBetween(0,50)
    ];
});
