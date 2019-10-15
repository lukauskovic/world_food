<?php

use Faker\Generator as Faker;

$factory->define(App\Meal::class, function (Faker $faker) {
    $faker->addProvider(new FakerRestaurant\Provider\en_US\Restaurant($faker));
    $categoryId = \App\Category::all('id')->random(1);
    return [
        'title' => $faker->foodName,
        'description' => $faker->text(20),
        'slug' => $faker->slug,
        'categoryId' => array_random(array($categoryId[0], null))
    ];
});