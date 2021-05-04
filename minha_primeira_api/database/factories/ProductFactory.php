<?php

use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->randomFloat(2, 0, 8), //o primeiro númmero e o número de casas decimais e depois o tamanho mínimo e máximo do campo
        'description' => $faker->text,
        'slug' => $faker->slug
    ];
});
