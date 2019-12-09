<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Cage;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Cage::class, function (Faker $faker) {
    return [
        'area' => $faker->name,
        'spaces_number' => $faker->area,
        'shelter_id' => $faker->phone,
    ];
});
