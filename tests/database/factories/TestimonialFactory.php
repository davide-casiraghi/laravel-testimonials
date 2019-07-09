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

$factory->define(DavideCasiraghi\LaravelTestimonials\Models\Testimonial::class, function (Faker $faker) {
    return [
        'name:en' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'body:en' => $faker->paragraph,
        'profession:en' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'testimonials_group' => 1,
        'image_file_name' => $faker->sentence($nbWords = 1, $variableNbWords = true).'.jpg',
        'gender' => 'm',
    ];
});
