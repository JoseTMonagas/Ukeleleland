<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
  return [
    'name' => $faker->name,
    'description' => 'Dolor optio amet dolorum libero tenetur? Ullam fuga sint praesentium alias nulla!',
    'address' => $faker->address,
    'image' => $faker->image,
    'price' => $faker->numberBetween(10000, 30000),
    'type' => 2,
    'commune_id' => $faker->numberBetween(1, 346)
  ];
});
