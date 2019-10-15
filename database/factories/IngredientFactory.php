<?php

use Bezhanov\Faker\ProviderCollectionHelper;
use Faker\Generator as Faker;

$factory->define(App\Ingredient::class, function (Faker $faker) {
    ProviderCollectionHelper::addAllProvidersTo($faker);
    return [
        'title' => $faker->ingredient,
        'slug' => $faker->slug
    ];
});
