<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(DavideCasiraghi\LaravelTestimonials\Models\TestimonialGroup::class, function (Faker $faker) {
    return [
        'title:en' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'quotes_color' => '#AA33BB',
        'max_characters' => '60',
        'show_title' => true,
    ];
});
