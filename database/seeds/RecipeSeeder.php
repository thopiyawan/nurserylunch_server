<?php

use App\FoodRecipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = array_map('str_getcsv', file('database/seeds/database/foodrecipe_unitchange.csv'));
        foreach ($csv as $key => $item) {
            $recipe = new FoodRecipe();
            $recipe->food_id = $item[0];
            $recipe->composition_id = $item[1];
            $recipe->cook_quantity = $item[3];
            $recipe->cook_unit_id = $item[4];
            $recipe->pur_quantity = $item[8];
            $recipe->pur_unit_id = $item[9];
            $recipe->save();
        }

    }
}
