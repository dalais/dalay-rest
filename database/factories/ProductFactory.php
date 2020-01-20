<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word() . ' ' . $faker->word() . ' ' . $faker->randomDigit,
        'short_description' => $faker->text(200),
        'description' => $faker->text(400),
        'price' => $faker->randomFloat(null, 0, 5),
        'average_rating' => mt_rand(0, 4). '.'. mt_rand(0,9)
    ];
});
