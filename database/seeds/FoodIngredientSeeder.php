<?php

use Illuminate\Database\Seeder;
use App\FoodIngredient;
class FoodIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $csv = array_map('str_getcsv', file('database/seeds/database/food_ingredient.csv'));
        foreach ($csv as $key => $item) {
            $ingredient = new FoodIngredient();
            $ingredient->food_id = $item[0];
            $ingredient->ingredient_id = $item[1];
            $ingredient->save();
        }
    }
}
