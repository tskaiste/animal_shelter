<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Donation;
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

$factory->define(Donation::class, function (Faker $faker) {
    return [
        'date' => $faker->date,
        'sum' => $faker->sum,
        'purpose' => $faker->purpose,
        'sender' => $faker->sender,
        'shelter_id' => $faker->shelter_id,
    ];
});
