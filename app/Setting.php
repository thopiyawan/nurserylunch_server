<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected static $mealdescription = array(1=>"เช้า", 2=>"ว่างเช้า", 3=>"กลางวัน", 4=>"ว่างบ่าย");
    public static $foodtypes = array(
        8=> array('id'=>8, 'key'=>'is_for_small', 'rest'=>'small', 'age_thai'=>'ต่ำกว่า 1 ปี', 'name_thai'=>'ปกติ'), 
        9=> array('id'=>9, 'key'=>'is_s_muslim', 'rest'=>'muslim','age_thai'=>'ต่ำกว่า 1 ปี', 'name_thai'=>'อาหารมุสลิม'), 
        10=> array('id'=>10, 'key'=>'is_s_vege', 'rest'=>'vege','age_thai'=>'ต่ำกว่า 1 ปี', 'name_thai'=>'อาหารมังสวิรัติ'), 
        11=> array('id'=>11, 'key'=>'is_s_vegan', 'rest'=>'vegan','age_thai'=>'ต่ำกว่า 1 ปี', 'name_thai'=>'อาหารเจ'), 
        12=> array('id'=>12, 'key'=>'is_s_milk', 'rest'=>'milk','age_thai'=>'ต่ำกว่า 1 ปี', 'name_thai'=>'แพ้นมวัว'), 
        13=> array('id'=>13, 'key'=>'is_s_breastmilk', 'rest'=>'breastmilk','age_thai'=>'ต่ำกว่า 1 ปี', 'name_thai'=>'แพ้นมแม่'), 
        14=> array('id'=>14, 'key'=>'is_s_egg', 'rest'=>'egg','age_thai'=>'ต่ำกว่า 1 ปี', 'name_thai'=>'แพ้ไข่ไก่'), 
        15=> array('id'=>15, 'key'=>'is_s_wheat', 'rest'=>'wheat','age_thai'=>'ต่ำกว่า 1 ปี', 'name_thai'=>'แพ้แป้งสาลี'), 
        16=> array('id'=>16, 'key'=>'is_s_shrimp', 'rest'=>'shrimp','age_thai'=>'ต่ำกว่า 1 ปี', 'name_thai'=>'แพ้กุ้ง'), 
        17=> array('id'=>17, 'key'=>'is_s_shell', 'rest'=>'shell','age_thai'=>'ต่ำกว่า 1 ปี', 'name_thai'=>'แพ้หอย'), 
        18=> array('id'=>18, 'key'=>'is_s_crab', 'rest'=>'crab','age_thai'=>'ต่ำกว่า 1 ปี', 'name_thai'=>'แพ้ปู'), 
        19=> array('id'=>19, 'key'=>'is_s_fish', 'rest'=>'fish','age_thai'=>'ต่ำกว่า 1 ปี', 'name_thai'=>'แพ้ปลา'), 
        20=> array('id'=>20, 'key'=>'is_s_peanut', 'rest'=>'peanut','age_thai'=>'ต่ำกว่า 1 ปี', 'name_thai'=>'แพ้ถั่วลิสง'), 
        21=> array('id'=>21, 'key'=>'is_s_soybean', 'rest'=>'soybean','age_thai'=>'ต่ำกว่า 1 ปี', 'name_thai'=>'แพ้ถั่วเหลือง'),
        22=> array('id'=>22, 'key'=>'is_for_big', 'rest'=>'big','age_thai'=>'1-3 ปี', 'name_thai'=>'ปกติ'), 
        23=> array('id'=>23, 'key'=>'is_b_muslim', 'rest'=>'muslim','age_thai'=>'1-3 ปี', 'name_thai'=>'อาหารมุสลิม'), 
        24=> array('id'=>24, 'key'=>'is_b_vege', 'rest'=>'vege','age_thai'=>'1-3 ปี', 'name_thai'=>'อาหารมังสวิรัติ'), 
        25=> array('id'=>25, 'key'=>'is_b_vegan', 'rest'=>'vegan','age_thai'=>'1-3 ปี', 'name_thai'=>'อาหารเจ'), 
        26=> array('id'=>26, 'key'=>'is_b_milk', 'rest'=>'milk','age_thai'=>'1-3 ปี', 'name_thai'=>'แพ้นมวัว'), 
        27=> array('id'=>27, 'key'=>'is_b_breastmilk', 'rest'=>'breastmilk','age_thai'=>'1-3 ปี', 'name_thai'=>'แพ้นมแม่'), 
        28=> array('id'=>28, 'key'=>'is_b_egg', 'rest'=>'egg','age_thai'=>'1-3 ปี', 'name_thai'=>'แพ้ไข่ไก่'), 
        29=> array('id'=>29, 'key'=>'is_b_wheat', 'rest'=>'wheat','age_thai'=>'1-3 ปี', 'name_thai'=>'แพ้แป้งสาลี'), 
        30=> array('id'=>30, 'key'=>'is_b_shrimp', 'rest'=>'shrimp','age_thai'=>'1-3 ปี', 'name_thai'=>'แพ้กุ้ง'), 
        31=> array('id'=>31, 'key'=>'is_b_shell', 'rest'=>'shell','age_thai'=>'1-3 ปี', 'name_thai'=>'แพ้หอย'), 
        32=> array('id'=>32, 'key'=>'is_b_crab', 'rest'=>'crab','age_thai'=>'1-3 ปี', 'name_thai'=>'แพ้ปู'), 
        33=> array('id'=>33, 'key'=>'is_b_fish', 'rest'=>'fish','age_thai'=>'1-3 ปี', 'name_thai'=>'แพ้ปลา'), 
        34=> array('id'=>34, 'key'=>'is_b_peanut', 'rest'=>'peanut','age_thai'=>'1-3 ปี', 'name_thai'=>'แพ้ถั่วลิสง'), 
        35=> array('id'=>35, 'key'=>'is_b_soybean', 'rest'=>'soybean','age_thai'=>'1-3 ปี', 'name_thai'=>'แพ้ถั่วเหลือง'), 
    );

    public static function getMealName($id){
        return Setting::$mealdescription[$id];
    }
    public static function getFoodTypeAgeThai($id){
        return Setting::$foodtypes[$id]['age_thai'];
    }
    public static function getFoodTypeName($id){
        return Setting::$foodtypes[$id]['name_thai'];
    }
    public static function getFoodTypeID($rest, $age){
        $id = 0;
        foreach (Setting::$foodtypes  as $key => $type) {
            if ($type['rest'] == $rest){
                $id = $key;
                break;
            }
        }
        if($age == "big"){
            $id = $id + 14;
        }
        // $id = 14;
        return $id;
    }



    // public static function getFoodSettingBySchoolId($school_id){
    //     return Setting::find($school_id);
    // }

    public function getMealSettings(){
        $mealSetting = array(
            array(1, "เช้า", $this->is_breakfast, "breakfast-meal"), 
            array(2, "ว่างเช้า", $this->is_morning_snack, "breakfast-snack-meal"), 
            array(3, "กลางวัน", $this->is_lunch, "lunch-meal"), 
            array(4, "ว่างบ่าย", $this->is_afternoon_snack, "lunch-snack-meal"), 
        );
    	return $mealSetting;
    }
}
