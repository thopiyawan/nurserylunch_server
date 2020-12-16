<?php

use App\Nutrition;
use Illuminate\Database\Seeder;

class FoodNutritions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = array_map('str_getcsv', file('database/seeds/database/food_nutrition.csv'));
        foreach ($csv as $key => $item) {
            $nutrition = new Nutrition();
            $nutrition->food_id = $item[0];
            $nutrition->energy = $item[1];
            $nutrition->protein = $item[2];
            $nutrition->carbohydrate = $item[3];
            $nutrition->fat = $item[4];
            $nutrition->vitamin_a = $item[5];
            $nutrition->vitamin_b1 = $item[6];
            $nutrition->vitamin_b2 = $item[7];
            $nutrition->vitamin_c = $item[8];
            $nutrition->iron = $item[9];
            $nutrition->zine = $item[10];
            $nutrition->calcium = $item[11];
            $nutrition->phosphorus = $item[12];
            $nutrition->fiber = $item[13];
            $nutrition->sodium = $item[14];
            $nutrition->sugar = $item[15];
            $nutrition->save();
            
        }
    }
}
