<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::all()->first->id,
        'review' => $faker->text(30),
        'rating' => mt_rand(0,5)
    ];
});
