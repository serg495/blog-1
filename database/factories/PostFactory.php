<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'summary' => $faker->realText(350),
        'body' => $faker->paragraph(55),
    ];
});
