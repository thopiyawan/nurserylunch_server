<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nutrition extends Model
{
    protected $table = 'nutritions';
    public static $dri = array(
    	array("age"=>"small", "dri_name"=>"energy", "toolow"=>285, "low"=>516, "ok"=>1161, "high"=>1419),
    	array("age"=>"small", "dri_name"=>"protein", "toolow"=>5.2, "low"=>10.4, "ok"=>23.4, "high"=>28.6),
    	array("age"=>"small", "dri_name"=>"fat", "toolow"=>10.04, "low"=>20.08, "ok"=>45.18, "high"=>55.22),
    	array("age"=>"small", "dri_name"=>"carbohydrate", "toolow"=>29.02, "low"=>58.04, "ok"=>130.59, "high"=>159.61),
    	array("age"=>"small", "dri_name"=>"vitamin_a", "low"=>200, "ok"=>450),
    	array("age"=>"small", "dri_name"=>"vitamin_b1", "low"=>0.24, "ok"=>0.54),
    	array("age"=>"small", "dri_name"=>"vitamin_b2", "low"=>0.32, "ok"=>0.72),
    	array("age"=>"small", "dri_name"=>"vitamin_c", "low"=>40, "ok"=>90),
    	array("age"=>"small", "dri_name"=>"iron", "low"=>7.2, "ok"=>16.2),
    	array("age"=>"small", "dri_name"=>"calcium", "low"=>208, "ok"=>468),
    	array("age"=>"small", "dri_name"=>"phosphorus", "low"=>220, "ok"=>495),
    	array("age"=>"small", "dri_name"=>"fiber", "low"=>3.2, "ok"=>7.2),
    	array("age"=>"small", "dri_name"=>"sodium", "low"=>0, "ok"=>0),
    	array("age"=>"small", "dri_name"=>"sugar", "low"=>0, "ok"=>0),
        array("age"=>"big", "dri_name"=>"energy", "toolow"=>406, "low"=>812, "ok"=>1827, "high"=>2233),
        array("age"=>"big", "dri_name"=>"protein", "toolow"=>6.2, "low"=>12.4, "ok"=>27.9, "high"=>34.1),
        array("age"=>"big", "dri_name"=>"fat", "toolow"=>15.78, "low"=>31.56, "ok"=>71.01, "high"=>86.79),
        array("age"=>"big", "dri_name"=>"carbohydrate", "toolow"=>45.6, "low"=>91.2, "ok"=>205.2, "high"=>250.8),
        array("age"=>"big", "dri_name"=>"vitamin_a", "low"=>240, "ok"=>540),
        array("age"=>"big", "dri_name"=>"vitamin_b1", "low"=>0.4, "ok"=>0.9),
        array("age"=>"big", "dri_name"=>"vitamin_b2", "low"=>0.4, "ok"=>0.9),
        array("age"=>"big", "dri_name"=>"vitamin_c", "low"=>20, "ok"=>45),
        array("age"=>"big", "dri_name"=>"iron", "low"=>4, "ok"=>9),
        array("age"=>"big", "dri_name"=>"calcium", "low"=>400, "ok"=>900),
        array("age"=>"big", "dri_name"=>"phosphorus", "low"=>368, "ok"=>828),
        array("age"=>"big", "dri_name"=>"fiber", "low"=>3.62, "ok"=>8.14),
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
