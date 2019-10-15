<?php

use Bezhanov\Faker\ProviderCollectionHelper;
use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'slug' => $faker->slug
    ];
});
