<?php

use Faker\Generator as Faker;

$factory->define(App\Meal::class, function (Faker $faker) {
    $faker->addProvider(new FakerRestaurant\Provider\en_US\Restaurant($faker));
    $categoryId = \App\Category::all('id')->random(1);
    return [
        'en'  => ['title' => "EN " . $faker->FoodName, 'description' => "EN " . $faker->sentence],
        'fr'  => ['title' => "FR " . $faker->FoodName, 'description' => "FR " . $faker->sentence],
        'es'  => ['title' => "ES " . $faker->FoodName, 'description' => "ES " . $faker->sentence],
        'categoryId' => array_random(array($categoryId[0], null))
    ];
});