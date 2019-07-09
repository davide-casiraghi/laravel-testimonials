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

$factory->define(DavideCasiraghi\LaravelTestimonials\Models\TestimonialTranslation::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'body' => $faker->paragraph,
        'profession' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'testimonial_id' => 1,
        'locale' => 'en',
    ];
});
