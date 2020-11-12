<?php

use Illuminate\Database\Seeder;
use App\Propertie;

class FoodProperties extends Seeder
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
        $csv = array_map('str_getcsv', file('database/seeds/database/food_properties.csv'));
        foreach ($csv as $key => $item) {
            $composition = new Propertie();
            $composition->food_id = $item[0];
            $composition->age6_8mo = $item[1];
            $composition->age9_11mo = $item[2];
            $composition->age1_2y = $item[3];
            $composition->age2_3y = $item[4];
            $composition->has_pork = $item[5];
            $composition->has_egg = $item[6];
            $composition->has_seafish = $item[7];
            $composition->has_shirmp = $item[8];
            $composition->has_flour = $item[9];
            $composition->save();

        }
    }
}
