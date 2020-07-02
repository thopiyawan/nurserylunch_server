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
                        "protein" => "โปรตีน" );

        $allIngredients = array(
            "meat" => array("หมู", "ไก่", "ปลา", "กุ้ง", "ตับ"), 
            "vegetable" => array("ผักใบเขียว", "ฝักทอง", "แครอท"),
            "protein" => array("ไข่", "เต้าหู้", "ถั่ว")
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

        // $ingredient_group = new App\IngredientGroup;
        // $ingredient_group->ingredient_group_name = "เนื้อสัตว์";
        // $ingredient_group->ingredient_group_eng_name = "meat";
        // $ingredient_group->save();

        // $ingredient_group = new App\IngredientGroup;
        // $ingredient_group->ingredient_group_name = "ผัก";
        // $ingredient_group->ingredient_group_eng_name = "vegetable";
        // $ingredient_group->save();

        // $ingredient_group = new App\IngredientGroup;
        // $ingredient_group->ingredient_group_name = "โปรตีน";
        // $ingredient_group->ingredient_group_eng_name = "protein";
        // $ingredient_group->save();


        // $i1 = new App\Ingredient;
        // $i1->ingredient_name = "ไข่";
        // $i1->save();

        // $i2 = new App\Ingredient;
        // $i2 ->ingredient_name = "เต้าหู้";
        // $i2 -> save();

        // $ingredient_group = $ingredient_group->contains()->saveMany([$i1, $i2]);



        // $user->name = "ศูนย์อนามัยที่ 5/ วัดเทพประสิทธิ์คณาวาส";
        // $user->email = "test@test.com";
        // $user->email_verified_at = now();
        // $user->password = "test1234"; // password
        // $user->remember_token = Str::random(10);
        // $user->save();

    }
}
