<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Employee;
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

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'first_name' => $faker->first_name,
        'last_name' => $faker->last_name,
        'age' => $faker->age,
        'phone' => $faker->phone,
        'email' => $faker->unique()->safeEmail,
        'bank_account_number' => $faker->bank_account_number,
        'shelter_id' => $faker->shelter_id,
    ];
});
