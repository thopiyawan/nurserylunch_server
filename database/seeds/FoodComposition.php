<?php

use App\Composition;
use Illuminate\Database\Seeder;

class FoodComposition extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //select csv file not inclusive header  
        //each data in csv array is array of each row of csv file 
        $csv = array_map('str_getcsv', file('database/seeds/database/food_composition.csv'));
        foreach ($csv as $key => $item) {
            $food = new Composition();
            $food->id = $item[0];
            $food->composition_name = $item[1];
            $food->save();
        }
    }
}
