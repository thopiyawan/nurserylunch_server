<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  $this->call(SchoolSeeder::class);
        $this->call(IngredientSeeder::class);
        $this->call(FoodSeeder::class);
        $this->call(FoodProperties::class);
        $this->call(FoodComposition::class);
        $this->call(FoodNutritions::class);
        $this->call(PurAndCookUnit::class);
        $this->call(RecipeSeeder::class);
        $this->call(DirSeeder::class);
        $this->call(FoodIngredientSeeder::class);
        $this->call(SettingDescriptionSeeder::class);
    }
}
