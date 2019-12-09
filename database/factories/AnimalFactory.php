<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Animal;
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

$factory->define(Animal::class, function (Faker $faker) {
    return [
        'type' => $faker->type,
        'name' => $faker->name,
        'color' => $faker->color,
        'breed' => $faker->breed,
        'size' => $faker->size,
        'age' => $faker->age,
        'gender' => $faker->gender,
        'is_sterilised' => $faker->is_sterilised,
        'cage_id' => $faker->cage_id,
    ];
});
