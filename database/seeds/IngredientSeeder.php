<?php

use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = array( "meat" => "เนื้อสัตว์", 
                        "vegetable" => "ผัก", 
                        "protein" => "โปรตีน",
                        'fruit' => "ผลไม้" );

        $allIngredients = array(
            "meat" => array("หมู", "ไก่", "ปลา", "กุ้ง", "ตับ", "เนื้อ"), 
            "vegetable" => array("ผักใบเขียว", "ฝักทอง", "แครอท"),
            "protein" => array("ไข่", "เต้าหู้", "ถั่ว", "นม"),
            "fruit" => array("ผลไม้เนื้อนิ่ม", "ผลไม้เนื้อแข็ง")
        );

        foreach ($group as $key => $value) {
            $g = new App\IngredientGroup;
            $g->ingredient_group_eng_name = $key;  
            $g->ingredient_group_name = $value;
            $g->save();
            $temp = array();

            foreach ($allIngredients[$key] as $newKey => $ingredient) {             
                $i = new App\Ingredient;
                $i->ingredient_name = $ingredient;
                array_push($temp, $i);
            }
            $g->ingredients()->saveMany($temp);
        }
    }
}
