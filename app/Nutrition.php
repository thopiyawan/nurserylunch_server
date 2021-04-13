<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nutrition extends Model
{
    //
    protected $table = 'nutritions';
    public static $dri = array(
    	array("age"=>"small", "dri_name"=>"energy", "toolow"=>322.5, "low"=>645, "ok"=>967.5, "high"=>1290),
    	array("age"=>"small", "dri_name"=>"protein", "toolow"=>6.5, "low"=>13, "ok"=>19.5, "high"=>26),
    	array("age"=>"small", "dri_name"=>"fat", "toolow"=>12.55, "low"=>25.1, "ok"=>37.65, "high"=>50.2),
    	array("age"=>"small", "dri_name"=>"carbohydrate", "toolow"=>36.275, "low"=>72.55, "ok"=>108.825, "high"=>145.1),
    	array("age"=>"small", "dri_name"=>"vitamin_a", "low"=>250, "ok"=>500),
    	array("age"=>"small", "dri_name"=>"vitamin_b1", "low"=>0.3, "ok"=>0.6),
    	array("age"=>"small", "dri_name"=>"vitamin_b2", "low"=>0.4, "ok"=>0.8),
    	array("age"=>"small", "dri_name"=>"vitamin_c", "low"=>50, "ok"=>100),
    	array("age"=>"small", "dri_name"=>"iron", "low"=>9, "ok"=>18),
    	array("age"=>"small", "dri_name"=>"calcium", "low"=>260, "ok"=>520),
    	array("age"=>"small", "dri_name"=>"phosphorus", "low"=>275, "ok"=>550),
    	array("age"=>"small", "dri_name"=>"fiber", "low"=>4, "ok"=>8),
    	array("age"=>"small", "dri_name"=>"sodium", "low"=>0, "ok"=>0),
    	array("age"=>"small", "dri_name"=>"sugar", "low"=>0, "ok"=>0),
        array("age"=>"big", "dri_name"=>"energy", "toolow"=>507.5, "low"=>1015, "ok"=>1522.5, "high"=>2030),
        array("age"=>"big", "dri_name"=>"protein", "toolow"=>7.75, "low"=>15.5, "ok"=>23.25, "high"=>31),
        array("age"=>"big", "dri_name"=>"fat", "toolow"=>19.725, "low"=>39.45, "ok"=>59.175, "high"=>78.9),
        array("age"=>"big", "dri_name"=>"carbohydrate", "toolow"=>57, "low"=>114, "ok"=>171, "high"=>228),
        array("age"=>"big", "dri_name"=>"vitamin_a", "low"=>300, "ok"=>600),
        array("age"=>"big", "dri_name"=>"vitamin_b1", "low"=>0.5, "ok"=>1),
        array("age"=>"big", "dri_name"=>"vitamin_b2", "low"=>0.5, "ok"=>1),
        array("age"=>"big", "dri_name"=>"vitamin_c", "low"=>25, "ok"=>50),
        array("age"=>"big", "dri_name"=>"iron", "low"=>5, "ok"=>10),
        array("age"=>"big", "dri_name"=>"calcium", "low"=>500, "ok"=>1000),
        array("age"=>"big", "dri_name"=>"phosphorus", "low"=>460, "ok"=>920),
        array("age"=>"big", "dri_name"=>"fiber", "low"=>4.52, "ok"=>9.04),
        array("age"=>"big", "dri_name"=>"sodium", "low"=>0, "ok"=>0),
        array("age"=>"big", "dri_name"=>"sugar", "low"=>0, "ok"=>0),
    );


    public function food(){
        return $this->belongsTo(Food::class);
    }

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public static function getDriByAge($school, $age, $isForFullWeek){
    	$returnDri = [];
        $mealMultipier = $school->getNumOfMealsPerDay();
        $dayMultipier = $isForFullWeek? $school->getNumOfDaysPerWeek() : 1;
    	foreach (Nutrition::$dri as $key=>$base) {
    		if($base['age'] == $age){
                $adjustedDri = $base;
                foreach ($adjustedDri as $key => $value) {
                    if($key!="age" and $key!="dri_name"){
                        $adjustedDri[$key] = $value * $mealMultipier * $dayMultipier;
                    }
                }
    			$returnDri[$adjustedDri['dri_name']] = $adjustedDri;
    		}
    	}
        return $returnDri;
    }

    
}
