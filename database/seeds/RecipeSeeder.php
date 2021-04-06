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
        $csv = array_map('str_getcsv', file('database/seeds/database/food_recipe.csv'));
        foreach ($csv as $key => $item) {
            $recipe = new FoodRecipe();
            $recipe->food_id = $item[0];
            $recipe->composition_id = $item[1];
            $recipe->composition_name = $item[1];
            $recipe->cook_quantity = $item[3];
            $recipe->cook_unit_id = $item[4];
            $recipe->pur_quantity = $item[5];
            $recipe->pur_unit_code = $item[6];
            $recipe->save();
        }
    }
}
