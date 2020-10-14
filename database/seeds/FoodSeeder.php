<?php

use Illuminate\Database\Seeder;

use App\Food;

class FoodSeeder extends Seeder
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
        $csv = array_map('str_getcsv', file('database/seeds/database/food_data.csv'));
        foreach ($csv as $key => $item) {
            $food = new Food();
            $food->id = $item[0];
            $food->food_group = $item[1];
            $food->food_thai = $item[2];
            $food->food_eng = $item[3];
            $food->save();
        }
    }
}
