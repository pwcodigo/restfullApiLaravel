<?php

/** @var Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->randomFloat(2,0,8),
        'description' => $faker->text



    ];
});
