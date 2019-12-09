<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Client;
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

$factory->define(Client::class, function (Faker $faker) {
    return [
        'first_name' => $faker->first_name,
        'last_name' => $faker->last_name,
        'age' => $faker->age,
        'phone' => $faker->phone,
        'email' => $faker->email,
        'activity_level' => $faker->activity_level,
        'home_type' => $faker->home_type,
        'has_yard' => $faker->has_yard,
        'shelter_id' => $faker->shelter_id,
    ];
});
