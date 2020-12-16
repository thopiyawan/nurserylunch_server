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
        $csv = array_map('str_getcsv', file('database/seeds/database/food_properties_full.csv'));
        foreach ($csv as $key => $item) {
            $composition = new Propertie();
            $composition->food_id = $item[0];
            $composition->age6_8mo = $item[1];
            $composition->age9_11mo = $item[2];
            $composition->age1_2y = $item[3];
            $composition->age2_3y = $item[4];
            $composition->is_safe_muslim = $item[5];
            $composition->is_safe_allegic_egg = $item[6];
            $composition->is_safe_allegic_fish = $item[7];
            $composition->is_safe_allegic_shrimp = $item[8];
            $composition->is_safe_allegic_wheat = $item[9];
            $composition->is_safe_vege = $item[10];
            $composition->is_safe_allegic_milk = $item[11];
            $composition->is_safe_vegan = $item[12];
            $composition->is_safe_allegic_peanut = $item[13];
            $composition->is_safe_allegic_soybean = $item[14];

            $composition->save();

        }
    }
}
