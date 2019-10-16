<?php

use Bezhanov\Faker\ProviderCollectionHelper;
use Faker\Generator as Faker;

$factory->define(App\Ingredient::class, function (Faker $faker) {
    ProviderCollectionHelper::addAllProvidersTo($faker);
    return [
        'en'  => ['title' => "EN " . $faker->ingredient],
        'fr'  => ['title' => "FR " . $faker->ingredient],
        'es'  => ['title' => "ES " . $faker->ingredient],
        'slug' => $faker->slug
    ];
});
