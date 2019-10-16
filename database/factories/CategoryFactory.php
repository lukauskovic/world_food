<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'en'  => ['title' => "EN" . $faker->word],
        'fr'  => ['title' => "FR" . $faker->word],
        'es'  => ['title' => "ES" . $faker->word],
        'slug' => $faker->slug
    ];
});
