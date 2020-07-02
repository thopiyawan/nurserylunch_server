<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Setting;
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

$factory->define(Setting::class, function (Faker $faker) {
    return [


        'is_weekday' => true, 
        'is_saturday'=> false, 
        'is_sunday'=> false,

        'is_breakfast'=> false,
        'is_morning_snack'=> true, 
        'is_lunch'=> true, 
        'is_afternoon_snack'=> true, 

        'is_for_small'=> false,
        'is_s_muslim'=> false,
        'is_s_vege'=> false,
        'is_s_vegan'=> false,
        'is_s_milk'=> false,
        'is_s_breastmilk'=> false,
        'is_s_egg'=> false,
        'is_s_wheat'=> false,
        'is_s_shrimp'=> false,
        'is_s_shell'=> false,
        'is_s_crab'=> false,
        'is_s_fish'=> false,
        'is_s_peanut'=> false,
        'is_s_soybean'=> false,

        'is_for_big'=> true, 
        'is_b_muslim'=> false,
        'is_b_vege'=> false,
        'is_b_vegan'=> false,
        'is_b_milk'=> false,
        'is_b_breastmilk'=> false,
        'is_b_egg'=> false,
        'is_b_wheat'=> false,
        'is_b_shrimp'=> false,
        'is_b_shell'=> false,
        'is_b_crab'=> false,
        'is_b_fish'=> false,
        'is_b_peanut'=> false,
        'is_b_soybean'=> false,
    ];
});
