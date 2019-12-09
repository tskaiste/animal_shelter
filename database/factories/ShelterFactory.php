<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Shelter;
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

$factory->define(Shelter::class, function (Faker $faker) {
    return [
        'address' => $faker->name,
        'area' => $faker->area,
        'phone' => $faker->phone,
        'email' => $faker->unique()->safeEmail,
        'bank_account_number' => $faker->bank_account_number,
    ];
});
