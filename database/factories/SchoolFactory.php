<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\School;
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

$factory->define(School::class, function (Faker $faker) {
    return [
        // 'name' => $faker->name,
        'name' => 'ศูนย์อนามัยที่ 5/ วัดเทพประสิทธิ์คณาวาส',
        'school_number' => '4-66-192-2201',
        'address' => '15/6',
        'tumbol' => 'omnoi',
        'amper' => 'kratumban',
        'province' => 'Samt Sakhon',
        'post_number' => '74130',
    ];
});
